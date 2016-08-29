/*
purple-include.js -- Purple Include (version 0.8)

Based on Mark Nottingham's most excellent hinclude.js (version 0.9)

Copyright (c) 2007 Jonathan Cheyer <jonathan@cheyer.biz>,
                   Eugene Eric Kim <eekim@blueoxen.com>,
                   Brad Neuberg <bradneuberg@yahoo.com>
Copyright (c) 2005-2006 Mark Nottingham <mnot@pobox.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

-------------------------------------------------------------------------------

See http://blueoxen.net/c/purple/purple-include/ for documentation.
See http://www.mnot.net/javascript/hinclude/ for hinclude documentation.

TODO:
 - check navigator property to see if browser will handle this without
   javascript

-------------------------------------------------------------------------------
*/

var hinclude = {
    set_content_async: function (url, element, req) {
        if (req.readyState == 4) {
            element.className = "included include_" + req.status;
            if (req.status == 200 | req.status == 304) {
                this.setHTML(url, req.responseText, element);
            }else{
                var origURL = url;
                if(url.indexOf("purple-proxy.php") != -1){
                    origURL = url.match(/(https?:.*$)/i)[1];
                }

                element.innerHTML = "<p>Include error for " + url + ": "
                                   + req.status + "</p>";
                element.className += " include_error"; 
            }
        }
    },

    buffer: new Array(),
    set_content_buffered: function (url, element, req) {
        if (req.readyState == 4) {
            hinclude.buffer.push({url: url, element: element, req: req});
            hinclude.outstanding--;
            if (hinclude.outstanding == 0) {
                hinclude.show_buffered_content();
            }
        }
    },
    show_buffered_content: function () {
        while (hinclude.buffer.length > 0) {
           var include = hinclude.buffer.pop();
           include.element.className = "included include_"
                                      + include.req.status;
           if (include.req.status == 200 | include.req.status == 304) {
                var replaceMe = include.element;
                this.setHTML(include.url, include.req.responseText,
                             include.element);  
           }else{
                var origURL = include.url;
                if(include.url.indexOf("purple-proxy.php") != -1){
                    origURL = include.url.match(/(https?:.*$)/i)[1];
                }

                include.element.innerHTML = "<p>Include error for " + origURL
                                           + ": " + include.req.status
                                           + "</p>";
                include.element.className += " include_error"; 
           }
        }
    },

    setHTML: function (url, html, element) {
        // parse out the anchor
        url = decodeURI(url);
        var anchor = url.match(/#xpath!(.*)$/);
        if(anchor){ // xpath! style
            anchor = anchor[1];
        }else{
            anchor = url.match(/#(.*)$/);
            if (anchor) { // purple number or anchor
                 anchor = "//a[@name='" + anchor[1] + "' or "
                         + "@id='" + anchor[1] + "']/.."
                         + " | "
                         + "//p[@name='" + anchor[1] + "' or "
                         + "@id='" + anchor[1] + "']";

            }
            else { // nothing; just grab whole document
                 anchor = "/body";
            }
        }       

        // simply write the HTML/XHTML into an iframe
        // and then get our DOM document -- this is the
        // only way to deal with unformed HTML, and it
        // actually turns out to be a more robust way of
        // dealing with XHTML than the DOMParser since
        // malformed XHTML will still work in an iframe,
        // but the DOMParser throws exceptions (and almost
        // everyone's XHTML is actually broken)
        var f = document.createElement("iframe");
        f.style.display = "none";
        document.getElementsByTagName("body")[0].appendChild(f);
        var doc = f.contentDocument;

        var self = this;
        // the iframe doesn't immediately parse the content --
        // it can take an arbitrary amount of time, so register
        // ourselves to continue working once the iframe is
        // finished loading 
        f.onload = function(){
            var origURL = url;
            if(url.indexOf("purple-proxy.php") != -1){
                origURL = url.match(/(https?:.*$)/i)[1];
            }

            // find XPath matches and serialize
            var isXML = /<\?xml/.test(html);        
            html = "";
            var matches;
            var exp = null;
            try{
                matches = self.evaluateXPath(doc, anchor, isXML);
            }catch(e){
                exp = e;        
            }

            if(!exp && matches){    
                for(var i = 0; i < matches.length; i++){
                    html += (new XMLSerializer()).serializeToString(matches[i])
                           + "\n";
                }
            }

            if(!exp && !matches.length){
                html = "<p>No include match for " + origURL + "</p>";
                element.className += " include_error";
            }else if(exp){
                html = "<p>Invalid include address for " + origURL + ": "
                      + exp.message + "</p>";
                element.className += " include_error";
            }

            // inline our HTML fragment now, to replace the 
            // hx:include element
            element.innerHTML = html;
        };

        // now have the iframe do its magic
        doc.open();
        doc.write(html);
        doc.close();
    },

    evaluateXPath: function (aDoc, aExpr, isXML) {
        var nsResolver = (isXML == false) ? null : function (prefix) { 
            return 'http://www.w3.org/1999/xhtml';
        };
        var nodes = aDoc.evaluate(aExpr, aDoc.documentElement, nsResolver,
                              XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,
                              null);
        var results = [];
        for(var i = 0; i < nodes.snapshotLength; i++){
            results.push(nodes.snapshotItem(i));
        }

        return results;
    },

    outstanding: 0,
    run: function () {
        var mode = this.get_meta("include_mode", "buffered"); 
        var callback = function(element, req) {};
        var includes = document.getElementsByTagName("hx:include");
        if (includes.length == 0) { // remove ns for IE
            includes = document.getElementsByTagName("include");
        }
        if (mode == "async") {
            callback = "set_content_async";
        } else if (mode == "buffered") {
            callback = "set_content_buffered";
            var timeout = this.get_meta("include_timeout", 2.5) * 1000;
            setTimeout("hinclude.show_buffered_content()", timeout);
        }
        for (var i=0; i < includes.length; i++) {
            includes[i].innerHTML = '<img src="roller.gif" />';
            this.include(includes[i], includes[i].getAttribute("src"),
                         callback);
        }
    },
    
    include: function (element, url, incl_cb) {
        var scheme = url.substring(0,url.indexOf(":"));
 
        if (scheme.toLowerCase() == "data") { // just text/plain for now
           data = unescape(url.substring(url.indexOf(",") + 1, url.length));
           element.innerHTML = data;
        }else {
            if(scheme) {
                var url_base = this.get_meta("purple_proxy_path",
                                 "/hypertext/purple-include/purple-proxy.php");
                url = url_base + "?url=" + encodeURI(url);
            }
            var req = false;
            if(window.XMLHttpRequest) {
                try {
                    req = new XMLHttpRequest();
                } catch(e) {
                    req = false;
                }
            } else if(window.ActiveXObject) {
                try {
                    req = new ActiveXObject("Microsoft.XMLHTTP");
                } catch(e) {
                    req = false;
                }
            }
            if(req) {
                this.outstanding++;
                var self = this;
                req.onreadystatechange = function() {
                    self[incl_cb](url, element, req);
                };
                try {
                    req.open("GET", url, true);
                    req.send("");
                } catch (e) {
                    this.outstanding--;
                    alert("Include error: " + url + " (" + e + ")");
                }
            }    
        }
    },

    get_meta: function (name, value_default) {
        var metas = document.getElementsByTagName("meta");
        for (var m=0; m < metas.length; m++) {
            var meta_name = metas[m].getAttribute("name");
            if (meta_name == name) {
                return metas[m].getAttribute("content");
            }
        }
        return value_default;
    },
    
    /*
     * (c)2006 Dean Edwards/Matthias Miller/John Resig
     * Special thanks to Dan Webb's domready.js Prototype extension
     * and Simon Willison's addLoadEvent
     *
     * For more info, see:
     * http://dean.edwards.name/weblog/2006/06/again/
     * http://www.vivabit.com/bollocks/2006/06/21/a-dom-ready-extension-for-prototype
     * http://simon.incutio.com/archive/2004/05/26/addLoadEvent
     * 
     * Thrown together by Jesse Skinner (http://www.thefutureoftheweb.com/)
     *
     *
     * To use: call addDOMLoadEvent one or more times with functions, ie:
     *
     *    function something() {
     *       // do something
     *    }
     *    addDOMLoadEvent(something);
     *
     *    addDOMLoadEvent(function() {
     *        // do other stuff
     *    });
     *
     */ 
    addDOMLoadEvent: function(func) {
       if (!window.__load_events) {
          var init = function () {
              // quit if this function has already been called
              if (arguments.callee.done) return;
          
              // flag this function so we don't do the same thing twice
              arguments.callee.done = true;
          
              // kill the timer
              if (window.__load_timer) {
                  clearInterval(window.__load_timer);
                  window.__load_timer = null;
              }
              
              // execute each function in the stack in the order they were added
              for (var i=0;i < window.__load_events.length;i++) {
                  window.__load_events[i]();
              }
              window.__load_events = null;
              
              // clean up the __ie_onload event
              /*@cc_on @*/
              /*@if (@_win32)
                  document.getElementById("__ie_onload").onreadystatechange = "";
              /*@end @*/
          };
       
          // for Mozilla/Opera9
          if (document.addEventListener) {
              document.addEventListener("DOMContentLoaded", init, false);
          }
          
          // for Internet Explorer
          /*@cc_on @*/
          /*@if (@_win32)
              document.write("<scr"+"ipt id=__ie_onload defer src=javascript:void(0)><\/scr"+"ipt>");
              var script = document.getElementById("__ie_onload");
              script.onreadystatechange = function() {
                  if (this.readyState == "complete") {
                      init(); // call the onload handler
                  }
              };
          /*@end @*/
          
          // for Safari
          if (/WebKit/i.test(navigator.userAgent)) { // sniff
              window.__load_timer = setInterval(function() {
                  if (/loaded|complete/.test(document.readyState)) {
                      init(); // call the onload handler
                  }
              }, 10);
          }
          
          // for other browsers
          window.onload = init;
          
          // create event function stack
          window.__load_events = [];
       }
       
       // add function to event stack
       window.__load_events.push(func);
    }
}

hinclude.addDOMLoadEvent(function() { hinclude.run(); });

