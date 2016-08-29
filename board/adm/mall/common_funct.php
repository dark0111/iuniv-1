<?
function show_product_image($size,$product_code)
{
	switch($size)
	{
		case 75 :
			if(file_exists("$dark_define[site_url]/sub/mall/dark_mall_prt_img/75/".$product_code."_1.jpg"))
			{
			echo"
			<img src=$dark_define[site_url].'/sub/mall/dark_mall_prt_img/75/'.$product_code.'_1.jpg' width='75' height='75' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
			}
			elseif(file_exists("$dark_define[site_url]/sub/mall/dark_mall_prt_img/75/".$product_code."_1.gif"))
			{
			echo"
			<img src=$dark_define[site_url].'/sub/mall/dark_mall_prt_img/75/'.$product_code.'_1.gif' width='75' height='75' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
			}
			elseif(file_exists("$dark_define[site_url]/sub/mall/dark_mall_prt_img/75/".$product_code."_1.png"))
			{
			echo"
			<img src=$dark_define[site_url].'/sub/mall/dark_mall_prt_img/75/'.$product_code.'_1.png' width='75' height='75' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
			}
			else
			{}
			break;
		default:
			break;
	}
}
?>