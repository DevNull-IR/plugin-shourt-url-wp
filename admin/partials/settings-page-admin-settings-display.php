<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       plugin_name.com/team
 * @since      1.0.0
 *
 * @package    PluginName
 * @subpackage PluginName/admin/partials
 */
include 'headers.php';
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
		        <div id="icon-themes" class="icon32"></div>  
		        <h2>Setting Wp f1r</h2>  
		         <!--NEED THE settings_errors below so that the errors/success messages are shown after submission - wasn't working once we started using add_menu_page and stopped using add_options_page so needed this-->
				<?php settings_errors(); ?>  
		        <form method="POST" action="options.php">  
		            <?php 
		                settings_fields( 'settings_page_general_settings' );
		                do_settings_sections( 'settings_page_general_settings' ); 
		            ?>      
										<span>
						<strong>
							لینک کوتاه شده به صورت خودکار نشان داده شود؟
						</strong>
					</span>
					<br>
					<section>
						<label for="radio_Yes">نشان داده شود</label>
						<input type="radio" name="wp_token_f1r_api_radio" id="wp_token_f1r_api_radio" value="One" <?php if(get_option("viewWhere") == "on") {?> checked <?php } ?> > <br>
						<label for="radio_Yes">نشان داده نشود</label>
						<input type="radio" name="wp_token_f1r_api_radio" id="wp_token_f1r_api_radio" <?php if(get_option("viewWhere") != "on") {?> checked <?php } ?> >       
					</section>
					<br>
					<section>
					<span>
						<strong>
							کدام صفحه ها لینکشون کوتاه شود؟
						</strong>
					</span><br>
						
						<input type="checkbox" name="posts_wp_f1r" <?php if(get_option("posts_wp_f1r") == "true"){ ?> checked="checked" <?php } else {?> value="on" <?php } ?> >
						<label for="articles">مقالات</label><br>
						<!--  -->
						<input type="checkbox" name="pages_wp_f1r" <?php if(get_option("pages_wp_f1r") == "true"){ ?> checked="checked" <?php } else {?> value="on" <?php } ?>>
						<label for="articles" >صفحات</label> <br>
						<!--  -->
						<input type="checkbox" name="attach_wp_f1r" <?php if(get_option("attach_wp_f1r") == "true"){ ?> checked="checked" <?php } else {?> value="on" <?php } ?>>
						<label for="articles">فایل ها</label><br>
						<!--  -->
					</section>
					<section>
						<span>
							<strong>
								قالب خروجی
							</strong>
						</span>
						<label for="selectBOX">تم خود را انتخاب نمائید</label>
						
						<select name="wp_f1r_theme" onchange="preview()" id="selectBox">
								<option value="Theme_one" <?php if (get_option("wp_f1r_theme") == "one"){ echo "selected"; } ?> >Theme One</option>
								<option value="Theme_tow" <?php if (get_option("wp_f1r_theme") == "tow"){ echo "selected"; } ?> >Theme Tow</option>
								<option value="Theme_there" <?php if (get_option("wp_f1r_theme") == "there"){ echo "selected"; } ?> >Theme there</option>
								<option value="Theme_foor" <?php if (get_option("wp_f1r_theme") == "foor"){ echo "selected"; } ?> >Theme foor</option>

								<option value="text" <?php if (get_option("wp_f1r_theme") == "text"){ echo "selected"; } ?> >Text</option>
							
							
						</select>
						<br><br>
						<img width="350px" src="" alt="perview" id="prew-one" style="display:none;">
					</section>
					<script>
						function preview(){
							
							let selectBox = document.getElementById('selectBox');

							let Pre = document.getElementById('prew-one');
							Pre.setAttribute("style" , "display:block;");
							if (selectBox.value == "Theme_one"){

								Pre.setAttribute("src" , "data:image/png;base64,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");
							} 
							if(selectBox.value == "Theme_tow"){
								Pre.setAttribute("src" , "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASAAAAAoCAYAAABepydZAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAVYSURBVHhe7ZlBbtswEEV7htwg5/HWJzGSnCPO2kdICrRoYRRZBk678KqLoN0U8LIoCh9B1ZAcajgcybRTynHyFw+oSIoiaf0XUn33/elXAwAAxwACAgAcjUEBXV1dvSkmk4m5Dh8/3zcfPn0BAOwJZcfKFAMBBUg+5+fn2RrQAv7+8xcAcCBDEioS0NnZ2auH5GMJiCxuLSoAoAzKkM4VAwEFICAA6rD6+i3LFQMBBSAgAOoAARUAAQFQBwioAAgIgDpAQAVAQADUAQIqAAICoA4QUAEQEAB1gIAKgIAAqAMEVAAEVJPH5no6ba5XVl3H0+qxeZJl7fWDvK7A091lc3H3syv78b65uHwfxuHHPSXmj10bbje92W987p7L5vaHUad4mPv1ovFN43j+N32/y8/m9tLP263NHuO2gIAKgIBqsltAWdBWN20A9gz43lDQ0mBJIfWG3wWSAlprfLRevu/xBcTyEXODgOoDAdXkhQqIgpWEOxUS7UL0zseNk3YGbbtq46O5h+eOKyBDPsQpCmix3jbbbcd6odrMls1G1G+362Yh6mfLjSvfLBfNctO12yxnoc0slG+a5cy6j9uVAQHVJLzod7xz8PCLz6H2tC/6kuSTtuMg3pIUuE4H00lL1Et5WCESQffwzqM7gnj4PqoP/zYE6cY4b8cojy+iXo+BBHfRrgmtDbWX67FzFxZwkkzmFcZO97gxqjknY5AC6pGPvOdOrq/qd4DRBaTlw0QJLdZmvZQJi8SC5ZLLxpZSCRBQTfyLnrzcKhxZ0FTAXT31EYURAsPXmWBkuGz4O0ssU0KydkCRPgENPdMQUB5kmtfAumQI4bTXfgw8Lr8GUoRpf7xGA/Ih3Li7Z8R++torxhVQ3NkICbBw1ov2miXB175NlFYo6wTU7YyyMn7WZtnMrOs9gIBqkgdBCyILmikg9cLLQCuh7Yaen/anhXSYgAZCaQlIy4Xa6KDrNpogiOs5jcmYQ7zfi6b7Hfxv4MTeSk9LJsL9S7GquQwxroAS2Rj1Z4tmrcTiiOLy5fZRiu9luaU7HvueMiCgmqSyscqKBJSFQ/bBf8UDfeJgVND1zoM4SEBWgBkVWrN/6leUFQmoxbWz5i3FnEkjCIj7D6LZdXTsLevhFQtItuNvRfsfvwgIqCZjCEjg7m2DRfQIhPpLgkaBUv0fQ0BUJuezs8+A64vmm7Xtdj15X/n6uTZ6TU9KQENHMHc0OvwI1n07EmXxeYEDjl8EBFST/yQgFfidITAk4cl3O9S//ss/voBoTfbskwjCvV75NdXzcH2Ej+NpnfW78E5SjOOkBNTS9xE67maiSDT5zsYi3RUJoWV15UBANdktoCzQ6gX3ApKBDUHha3d/Goh+gbTPVqF+mOdhGl1AVK+et1tASjrGOvjnts/KhGH9Li3cnp+rxt21ydfMYnQBEVpCmRj0zkUdyeQRTPZlCiYK7bDjFwEB1aRAQOG62/7zX+L0+JD8N7wVVq4jZHBlYCikyb307FQmxPMF1B1/3LUKre6f7jd3L3JOEeonrJESlOs3GZvdrldAhJtfew+N7xQF9Fzsb0A9JEc8o74ACOhlk4cblKNEODKvXEDdEaxIVj1AQC8bCOgZuN1KvsMbi9crIPktqfd/3cqAgF42ENBh+ONYzzFrJE5SQGMDAQFQBwioAAgIgDpAQAVAQADUAQIqAAICoA4QUAEQEAB1gIAKgIAAqMOzBDSZTGI43wJ6DT5+vjcXFQBQBmVI54oZFNBbkw9hrQMtIO2EyOQAgHKG5EMMCggAAGoCAQEAjgYEBAA4GhAQAOBoQEAAgCPxq/kHg+vhldxWrhQAAAAASUVORK5CYII=");
							}
							if (selectBox.value == "Theme_there"){
								Pre.setAttribute('src' , "data:image/png;base64,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");
							}
							if (selectBox.value == "text"){
								Pre.setAttribute('src' , "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAI0AAAAeCAYAAAARrJ1IAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAUjSURBVHhe7ZrPSyNJFMf3b8whhxwM9KEPgkIaMujQxEWWSAyrQsCBwAQiKsSQICFK4wwJGIhMwCARZsDD/CvffVX9s6qrE9tN4rrU4QNaVV31+tW33nvV+sfs529oNGnQotGkRotGkxotGk1qtGg0qYmJZvowRNd5xFRq/08yc7BfOMHlg6JvdI7t3SbuZt7vsxFOd4vI5i1kiLITGbtOZLvelWfc9R3cTVR9ycREc3+xj8xuG/dSe0jCQrNH9PpD3K/RGeNWGZlCEwNF321tB9kDJxD/9PoEGeMEV9P4WMZk2MXR8Tl6Cf1KHtrYzu+joRJtAoJdTo0EXENPGrMcvqOsOBwT8kOWbK5zm9VjFvEG0SQs9AYH/jt+oF6wsH3xGO+jCFQyRBuT3+sJl1Xbi0Artl+2a+2iGeFw08JGbTRnzGI+rmhGTZj5Ms4UoZVFlaxZx22kTfVe01EbFm1itvgVvQ7bwNXaH7NrzaLhPhCi7TJFY5bxybaRM3ewQU7N7X7FLV/IXYTVBAFsI7hgpPbj73y+3jH9XKD5ijt8vpxRhHnQi2zeI66qZVqniI0tG0ahgqP+k9eXjJx+Qp5xZlswmz+CNv5Ogn3eRk2/46zjrcU3MBSNL7LBg4OjP/eQ895HQDgo3gb0KX23arA2y5IA43bNF80YpyySNsNIOunXyH/upg8aNjIHN+L7q+zxBeFFuU+d53C8N8a0K9jcLCJHZA0bpY4iekdQi2aLTt7sxWv7hasDOo2B0xLUmRBpuGhscn4w3xhH5Azfee7mnEuR7SVwhr95Qj93wA4Ov0XafBIikHKeKCrRsChEYt6utnE5jDrbQ7FJWfYME35Lqu9Udi2KNN/qdJgquGTPzIYoU2oJNp36cob47KRTidR44j4NGnuK+s8d87n1FIqP2xnfxyivSk+8iCz6G/sG0Uin9L5JL+CtwftJNKpilo9NsEdOPz4DNrfdxVhqf5NoiuoiO0AhmtK1fzhElHYtEg0d2G6VRdQb9GjTs4L9tJ5wcF744TYa47Cfi7hIa7DoasFqycJX7SVFuC0L+/1om8jrahrh5ZYgGraGN9/UqcOg05nJs/RURqlxg8HcG4wizAcMcWiqN+5Nopk3nqEQTcwvnAS7FoqGmN7wtJIx5HSnEIkgIteeEkWmyfQZPUrnSZFGtPkRjd2EC4bHu4uGt9F1/bbTxlG1AlPpoAgpC2Cf9xRNol1pRJPfw+lI7OPpyLcxlq4ke7x5RDGsTTSUW2nxmHMmrxcNL+JoDTmFcKYO9ulUbl+oi2H+rCL9+CcvVxtK7S7vJ5o5di0UTZieuixSyPbw9anmURbGcXvGJLKsXyMljFmRaJ74pMapf9f3ccX0WajOFaIJROEZNfsl3gD4iQjDrGhPcvqZTbqw6DTWpdPosxzRSA59jWjm2bVINLwQ9qKuXAhz3PqjdD3mdqluRqI97o0sV3UwSRyzEtFQWKQ6hKcRWjAskNmzFQqRXjsZxtq4aNjvVJAZW3SlM21YNSeIFOPW3zDoqhf276F0MfZeSrKHfVcpqNPPpP8F5l+qCOTyXqKZaxdf0/NPFL6u4srN0pz0VZt9enCfC213SRAxE2KeHUp28JYkmmWjSk+a5cJrm60FN70lokXz4fFrJrlcWB1aNB8eSjGqi8kKWbloBp0vKHdU31Q0S4H9meO4jds1/nfBykWj+f+hRaNJjRaNJjVaNJrUaNFoUqNFo0mNFo0mNVo0mtRo0WhS8hv/AKy6MJfhEr88AAAAAElFTkSuQmCC");
							}
							if (selectBox.value == "Theme_foor"){
								Pre.setAttribute('src' , "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXwAAAA3CAYAAAAPD/HRAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAA6ySURBVHhe7Z3dayTHFcXzH0Ur7cPioED0shBEEoUgAoJYButBLyKgF0FQ/JUgm2gNWttysJyIEGUdYVvGK3st46w/ZG8U22Jhs3GId6Q1hvwfnXOqu2puVVe3vja2pjkPP0YzXV1Vt+reU7ere0bfufPfwyLHrfv3i0e2esXF35cMPX4DvFMMP70bPhNCCPHtQT2+AF2+AH32nz0K3b71VV7XGwX/F6/ecyePXL0bVSaEEOL8MfTrt51e8++HX7uX1fWs4L+wd+BOGnn+X8Xws/tRpUIIIc4nI1c+L0Ze+Lf7e/UfdW2vCf4HvcPiobUyux96YieqTAghxPlmaPG6e6WOf3R4P9L3muA/9X6Z3V946mZUiRBCiMFg+Mn33OtvPuhF+l4T/Nk3S8Efqk4QQggxWAw9+Tf3Onv9CMH/0V/KEy5c+SyqQAghxGAwvFzq94+h51bfa4LvTxh58cvwtxBCiMHB6rfV90bBF0IIMfhYfZfgCyFEh7H6LsEXQogOY/Vdgi+EEB3G6rsEXwghOozVdwm+EEJ0GKvvEnwhhOgwVt8l+EII0WGsvkvwhRCiw1h9l+ALIUSHsfouwRdCiA5j9V2CL4QQHcbqe2cFf+yNXrF8+6DYvndQ7B6UbOH9PD73ZS7fOCjW7hwUG2DpRny+59KrZT0ss7rbK0aT4xPvoo67B8VO1cZNtLfxaa+Y/mu/TFs74zyfx1DHBtqZRXv2+MU/9Yr5T6vjYH2/V0z9OSkDRmHXCvvJcqavof/V+TUa7GK/1n2/mkC9c6a/bGtxH+Nsxnwb5ZberdffxnHmLoDxmb11UGz+B2Nfld35orRpfD0u2zgW+GzxPczTy+jn6/1xXMc8TqJ+W8dFjP2Cnw/2CeWj44ZL8AGW3ULfmsZj9HqvWOU4gxX0IRqnl3rFDGzzbc1wrBN/COD8NfR3/i20a+potJnt3UL9Zv7I1G55rFbeg7o45zYu1lDPGPpq67mIsZzdq86BT0xvGltayI55WpeJLRJ8H31Z/bAcwxBzSf3s/zLKTNgYQt+D3ZV9tv5Bx+p79wSfAQGn2Evs6oOgg2iOw4km4YD71WdbcFobKJ7RtyAg1bl7d3Fe5dh0+BUIS73+iq/hcJXzNbVDUd352p+DY3uZwLnWK9YOfJmy3CbELOorbJmHo/bL9Ptq+9+EtcszjQAr+9wGRAMCw/KTCJi+LSkQYwRbGqg1TjB3LD8G2zYgovmyh8U+FoxFCKqv/8ixQF0rH/SKZ8K8YqwxX1aEOZe+f3sol1t8XbnW8TgsdjEeMxiP8fewEFSf7cC2aP6xYC36vsCflmlLzR/q7OIc1s06jp5/M6Zoex79ypfzlHMe1wuhhq9HPom5XMZC545/Vc5DsKUNzMEsbAz15OpKFtkxxNHN6vzd2xB72NGPuQYwnuyzm9vI7r5PdwVrd7cEH047B8GIJxoBBSfZjYIPk41s6tSCD4dc8Q7ogQOxnUis8H4BzplrhxnIdvjP8mgDQccMM20/F+D7aHvaCM3oG6g3+S/1ZxV8J1hVVkq7+uWrzwgFFdnVxIf9gHOgPK90mHHbuaBA2n5HnHDuRq9DjK3NHH+0yT5Hc4D3C9WVQTQWLM+yqSjjs1/Bnm3/Oc+vBOYSXjd8mxTgBmGojQf6vEc7onEsBf7nZxL8qt6aHZU/pfNf2VzzU44pBRvlTyf4AHUumcU1J/hMSvxVWDQWvl/gZs5Hzir4xu7Iv1gXfSOyW4I/MFxOM2ZcHk7AWdxxCMo0nGAHk78Dp+Dl/mkFP8p+4TTM5EOgwlkX4Nh7aGej2ipJ27kciRWcFf2ZSLYfAtmMzmRUaHe2JpR5wc8J+3GguHoB3PsC9pi+OhE0AsSxtVnvBATNLmy032bMnhPN3Su9Yslki3sQA7u1wkv8NYi/P74Luzm+TWPBbZzVsIBj3j7qFTNmTDk/l9GXuXAVhXrQv9rVGOCV37oZD17Z2G26cSz0mxAf9nn2rBk+6rHZMOsKCw3sn8GxxvnH68ynfRt378BGjPNxha8m+ICJiL+yOEqkJ5BQlIsO/ANXtjmfCJxJ8JPYhm/2fae6WkZ5Cf6ggUk7TkCOwiFHq0z6VIIPsVkNYgKxR7aZnsO+jKEdX59tZxtBtmkEnIFW27O0ZAW/n+VT3KJMt+KbEnxeCdgtjpwt48h4vailVyeOE86d7Q9FL7ePHo1Llcm1jUU0RxQgtBUWDYjtGhZ5vyBxq4hibdvz9IWsHI/cls8lfMYFhH8/SMG/aBcbHJvjeLXYPIbFxwulO/bHswk+oT+75OW8Cj6YCglbdQzlJfiDBoIobLMwOI4xaacR/J+9ibJebKosKj0npd9ODLO8I8+3AQ5n3zHZMrc2bHbP+qIAhiNHgYlx8ZfO4RIa5xx1k6pR8FH/rBHqjXQf10PxNDb4LZLACefOLiAu+zYiFmC2eqffNy7MbeLHjN6X9QLErRnfTp9y3LN2JuNRu9eS4f+V4YeEoMlmvNoMn+M4FmX4qANzlfqLv6cR1Yu27FWcK4O2z2uGv2wyfPosx0KCP2jA8VfvVXbQKbg3lytnOJXgb/fFL5utZmgSfPYz2vfMkQT4UiLwYe8egrCKIEqDOxL8HJkASmkTfCuqFML0XAcF3WfLubk54dzZLNqJZKYM+2avGhjYdiw4d0sQ5EXUtQIb+vcJMI7vVnXAzgUjgIQZbPr0TyAZDycmuXKGMwk+2vB7+PH9AcwXrpJSYY4W/GBvWX6NNrP/ib0pvo9pXMxgHMPiSF+EL5wPwS/P8XZ7v3Hgvbs6jOyW4A8G1ikwaSFoWziN4P9ky2wV0GGOyI5JTfBNsFF4wr5njkTw+V/o+3vmfbhPPYlLdNvXmuDj/E04dvSYGhaQo56eadvSyWXG9lzCff7WMTvh3F02Ikk7s/c/UKfdq2Wd0Vg0kG6x0fawqEI4WhdojPdxxsNiBd+LVThuxwUiusSFMBL8HBA/2OC3ko62GT6BfrqFJhE+Pt4a+QoWM//oaBoXXASje0n0NbvIPyjB5zgkc2DH0F2pwI7GJMuDPq3AJ1zMJ3ZL8AeEfrBRmDLZN97PIuuaQtDw/WkEfxx1WHFiJpVuKfDG3TwCwz91Y52P+798Vtre2GPWlN2WIKngQ5ynzaW4A0GwciPTV9SZ+yzbTgttgs+brT67cmKeBDaDKdp2ahDok8xd+rRMboGw2xvsF7etmsUP4oMy/P5EuFHsSce/8p0m7GLE8v4JoQDGYwq+MVuNE/fRfZ/c4m/q532IsNhUNkT9ge1bEKpNjFfwB4qraTOyGXVwwef3JNx7EI01+nZc4cv6FWMD9fm6A2cVfMRR/0oL82S3yir/8sd8XTbmeCVMu+12aBRzJ7B7ECntKumU4EfZGNiDY6/AOSYRJFMIxI3K0fmc8jQ+O5XgwznivV0IC5xlEaIzhjrnUGe5n1ktBnDWXDvpUymN+8I2wCvBiZ+MKbP7pqdQsoGZa6eFNsF3QR4WQIgW+rgCYXaX/ejnMrLCIEaw020dmLo9J5q7V+JFhMK3gUCfpHChPL+YdNOMrReBU41FZvyz5Tw4Hj2yC7FbR/v8gtNlCMkKfMX1G3U5Yeb9Db+dhb7uYLxYdgxZ7JqpJ2wl5foDu6OnloyI52yuPVnlxQ+cSfD5OWyqXYGeVfABYyhsx6A+bhmNYXHmF7LCXDPxqfqcizl+7yUkAfg8xNwJ7B5ESrtKOiX4ZLL2DHQGBhsCymYBORgIP3w749gQ8foz43UYeMzYmhaWqcSJs3vXuQDH5yHLr7J7fnaU4DfBq46ZSiBytAo+j+eCvAZsR2C7rQNzruUkc9eYTSa4ra4qa/9GBB9wvHJPTkVg3vyjtXzSqZ9AZIBvhBvZDf2Jn9bqj3WTzdEVEPrirpJwrC98TcA2LMQ/aBnLOJkBD0DwuTDWvvuSwK0sf38lG3PoY7rtVN/Dz9Fyf2oAsLZ0TvAJV3I+65zaRpgh+m2HUws+24Hoz9jsIgJOfBuCXolok+C7m4LhJl8sToEmwcErtzgWeGVRbR19W4LvymBMQ/aagoBfQ19HjSg0cdy5c6DPCwjgrFhCxKJn+cE3JfiEAmwzdAuvgpYxb8EP0I/yewYNZbGgh7It/YkWjkrEG21m0nI7Eb+tByP4zh7ERpTMnFXwgfu+RHaRR18Qb+4KryrbGHPJwuFiDudJ8AcdON0EAmURjsffhOHvhswmGTQdaB7Ou9jAHDLJSwioeTjPMurhtk3NMSF+03CGZQiP+50OnDeV3AS17cwkju+F27WJV25hRMcRmNzz5fEFvGa/jesxdYXfVLH1N2AXjSwIiFAv7xXY4E4Y5f0LBPMqxmIVgezqbimf5RhzF1H1j3OwDjiO4+nCSXLjcxQnGf8M/F2gBfgPf9fF/dZN2/g5O2Avxm4NV3DZeWnrD4/hHB4jc7SxzWYzr4RbSeMos1C9b8L9/s5RY5n0M52P0k/K461zm4FbY843qnhLfw+ItMWcbdvFHMah1W6Umc60MShYfe+u4AshhIj0XYIvhBAdxuq7BF8IITqM1XcJvhBCdBir7xJ8IYToMFbfJfhCCNFhrL5L8IUQosNYfZfgCyFEh7H6LsEXQogOY/Vdgi+EEB3G6rsEXwghOozVdwm+EEJ0GKvvEnwhhOgwVt8l+EII0WGsvtcEf+JaWWjot+/XThRCCHH+8fr902vx7/zXBJ+/oe1OWLweVSCEEGIwGFrcdq+/fPsIwf/dxweu4IWl3WLkxS+jSoQQQpxvqNvD0G/+/Sz03Op7TfA/Pjwsvv/yPVfYrxJCCCEGg+8+9pZ7pY7fSv63ck3wyUuflVn+yHN3i+Er+1FlQgghzifDVz4vRp7/wv39h8/r/6c3K/jkka2qgqv/LIYeuxFVKoQQ4nxx4fEbxcjVu+7vR9+In87xNAr+J/cPi4df61c2hMqGnninGH7mk/CZEEKIb4/hp3ch9O84sfefTb/eq23leBoF3/Pc3w+Lh14q9/SFEEKcT763dq+4Cr3O6XjJYfE/6QMclxduY+kAAAAASUVORK5CYII=");
							}
						}
						
					</script>
					<?php
					if (get_option("wp_f1r_theme") == "foor"){
						$name_ccc = get_option("wp_f1r_foor_text_copy") ? get_option("wp_f1r_foor_text_copy") : "Click me to copy current Url";
						$color_ccc = get_option("wp_f1r_color_foor") ? get_option("wp_f1r_color_foor") : "#3498db";
						?>
						<br>
						<section>
							<span>
								<p>
									متن دکمه کپی لینک
								</p>
							</span>
							<input type="text" name="wp_f1r_foor_text_copy" value="<?= $name_ccc ?>">
							<br>
							<p>
								<span>
									رنگ دکمه:
								</span>
							</p>
							<input type="color" name="wp_f1r_color_foor" value="<?= $color_ccc ?>">
						</section>
						<?php
					}
					if (get_option("wp_f1r_theme") == "there"){
						$bck_there = get_option("wp_f1r_backgrond_there") ? get_option("wp_f1r_backgrond_there") : "linear-gradient(135deg, #FDEB71 10%, #F8D800 100%)" ;
						$name_ccc = get_option("wp_f1r_buttom_there") ? get_option("wp_f1r_buttom_there") : "Click me to copy current Url";
						?>
						<br>
						<section>
							<span>
								<p>
									<strong>
										متن دکمه کپی لینک
									</strong>
								</p>
							</span>
							<input type="text" name="wp_f1r_buttom_there" value="<?= $name_ccc ?>">
							<br>
							<p>
								<strong>
									بکگراند
								</strong>
							</p>
							<strong>در این قسمت نیاز به داشتن علم css دارید در غیر این صورت دست نزنید</strong><br>
							<input type="text" size="50" name="wp_f1r_backgrond_there" value="<?= $bck_there ?>">
							<p><strong>وسط چین؟!</strong></p>
							<select name="centered_wp_f1r_there" id="centered_wp_f1r_there">
								<option value="center" <?php if(get_option("centered_wp_f1r_there") == "center"){ ?>selected<?php } ?>>center</option>
								<option value="left" <?php if(get_option("centered_wp_f1r_there") == "left"){ ?>selected<?php } ?>>left</option>
								<option value="right" <?php if(get_option("centered_wp_f1r_there") == "right"){ ?>selected<?php } ?>>right</option>
							</select>
						</section>
						<?php
					}
					if (get_option('wp_f1r_theme') == "tow"){
						?>
						<br>
						<section>
							<span>
								<strong>
									سایز قالب:
								</strong>
							</span>
							<p><strong>مقدار Assumption مقدار پیش فرض می باشد اگر خروجی برای شما مشکلی ندارد ان را تغییر ندهید در غیر این صورت به px مقادیر را وارد کنید</strong></p>
							<!-- <input type="text" value="Assumption" name="wp_f1r_size_of_box_one"> -->
							<input type="text" value="<?php if (get_option("wp_f1r_size_of_box_tow") == null) { ?>Assumption<?php } else { echo get_option("wp_f1r_size_of_box_tow") ;} ?>" name="wp_f1r_size_of_box_tow">
							<br><span>
								<strong>
									متن دکمه:
								</strong>
							</span>
							<input type="text" name="wp_f1r_name_copy_tow" value="<?php if (get_option("wp_f1r_name_copy_tow") == null) { ?>copy<?php } else { echo get_option("wp_f1r_name_copy_tow") ;} ?>">
							<p>
								<strong>
									رنگ دکمه کپی : 
								</strong>
							</p>
							<input type="color" name="wp_f1r_color_tow_theme" value="<?php if (get_option("wp_f1r_color_tow_theme") == null) { ?>#2564b8<?php } else { echo get_option("wp_f1r_color_tow_theme") ;} ?>">
							<p>
								<strong>
									رنگ لینک : 
								</strong>
							</p>
							<input type="color" name="wp_f1r_color_text_tow_theme" value="<?php if (get_option("wp_f1r_color_text_tow_theme") == null) { ?>#fff<?php } else { echo get_option("wp_f1r_color_text_tow_theme") ;} ?>">
							<p>
								<strong>
									رنگ متن دکمه کپلی لینک
								</strong>
							</p>
							<input type="color" name="wp_f1r_color_buttom_hover_tow_theme" value="<?php if (get_option("wp_f1r_color_buttom_hover_tow_theme") == null) { ?>#2564b8<?php } else { echo get_option("wp_f1r_color_buttom_hover_tow_theme") ;} ?>">
						</section>
						<?php
					}
					?>
					<?php
					if (get_option('wp_f1r_theme') == "one"){
						?>
						<br>
						<section>
							<span>
								<strong>
									سایز قالب:
								</strong>
							</span>
							<p><strong>مقدار Assumption مقدار پیش فرض می باشد اگر خروجی برای شما مشکلی ندارد ان را تغییر ندهید در غیر این صورت به px مقادیر را وارد کنید</strong></p>
							<!-- <input type="text" value="Assumption" name="wp_f1r_size_of_box_one"> -->
							<input type="text" value="<?php if (get_option("wp_f1r_size_of_box_one") == null) { ?>Assumption<?php } else { echo get_option("wp_f1r_size_of_box_one") ;} ?>" name="wp_f1r_size_of_box_one">
							<p>
								<strong>
									رنگ قالب : 
								</strong>
							</p>
							<input type="color" name="wp_f1r_color_one_theme" value="<?php if (get_option("wp_f1r_color_one_theme") == null) { ?>#2564b8<?php } else { echo get_option("wp_f1r_color_one_theme") ;} ?>">
							<p>
								<strong>
									رنگ لینک : 
								</strong>
							</p>
							<input type="color" name="wp_f1r_color_text_one_theme" value="<?php if (get_option("wp_f1r_color_text_one_theme") == null) { ?>#fff<?php } else { echo get_option("wp_f1r_color_text_one_theme") ;} ?>">
							<p>
								<strong>
									رنگ دکمه در زمان هاور (زمانی که موس میاد روی دکمه کپی لینک) : 
								</strong>
							</p>
							<input type="color" name="wp_f1r_color_buttom_hover_one_theme" value="<?php if (get_option("wp_f1r_color_buttom_hover_one_theme") == null) { ?>#2564b8<?php } else { echo get_option("wp_f1r_color_buttom_hover_one_theme") ;} ?>">
						</section>
						<?php
					}
					?>
		            <?php submit_button(); ?>  
		        </form> 
				<!-- <form method="POST" action="options.php"> -->
					<!-- <?= settings_fields( 'radio_wp_f1r_settings' ); ?> -->
					
					<!-- <?= do_settings_sections( 'radio_wp_f1r_settings' ); ?> -->
					
					<!-- <input type="text"> -->
					<!-- <?= submit_button(); ?>   -->
				<!-- </form> -->
</div>