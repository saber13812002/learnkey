!function(n){function i(){var n=location.href;return hashtag=-1!==n.indexOf("#prettyPhoto")?decodeURI(n.substring(n.indexOf("#prettyPhoto")+1,n.length)):!1,hashtag&&(hashtag=hashtag.replace(/<|>/g,"")),hashtag}function r(){"undefined"!=typeof theRel&&(location.hash=theRel+"/"+rel_index+"/")}function u(){-1!==location.href.indexOf("#prettyPhoto")&&(location.hash="prettyPhoto")}function t(n,t){n=n.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");var r="[\\?&]"+n+"=([^&#]*)",u=new RegExp(r),i=u.exec(t);return null==i?"":i[1]}n.prettyPhoto={version:"3.1.6"};n.fn.prettyPhoto=function(f){function y(){n(".pp_loaderIcon").hide();projectedTop=scroll_pos.scrollTop+(h/2-e.containerHeight/2);projectedTop<0&&(projectedTop=0);$ppt.fadeTo(settings.animation_speed,1);$pp_pic_holder.find(".pp_content").animate({height:e.contentHeight,width:e.contentWidth},settings.animation_speed);$pp_pic_holder.animate({top:projectedTop,left:s/2-e.containerWidth/2<0?0:s/2-e.containerWidth/2,width:e.containerWidth},settings.animation_speed,function(){$pp_pic_holder.find(".pp_hoverContainer,#fullResImage").height(e.height).width(e.width);$pp_pic_holder.find(".pp_fade").fadeIn(settings.animation_speed);isSet&&"image"==p(pp_images[set_position])?$pp_pic_holder.find(".pp_hoverContainer").show():$pp_pic_holder.find(".pp_hoverContainer").hide();settings.allow_expand&&(e.resized?n("a.pp_expand,a.pp_contract").show():n("a.pp_expand").hide());!settings.autoplay_slideshow||a||b||n.prettyPhoto.startSlideshow();settings.changepicturecallback();b=!0});et();f.ajaxcallback()}function g(t){$pp_pic_holder.find("#pp_full_res object,#pp_full_res embed").css("visibility","hidden");$pp_pic_holder.find(".pp_fade").fadeOut(settings.animation_speed,function(){n(".pp_loaderIcon").show();t()})}function ut(t){t>1?n(".pp_nav").show():n(".pp_nav").hide()}function o(n,t){if(resized=!1,nt(n,t),imageWidth=n,imageHeight=t,(l>s||c>h)&&doresize&&settings.allow_resize&&!v){for(resized=!0,fitting=!1;!fitting;)l>s?(imageWidth=s-200,imageHeight=t/n*imageWidth):c>h?(imageHeight=h-200,imageWidth=n/t*imageHeight):fitting=!0,c=imageHeight,l=imageWidth;(l>s||c>h)&&o(l,c);nt(imageWidth,imageHeight)}return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(c),containerWidth:Math.floor(l)+2*settings.horizontal_padding,contentHeight:Math.floor(k),contentWidth:Math.floor(rt),resized:resized}}function nt(t,i){t=parseFloat(t);i=parseFloat(i);$pp_details=$pp_pic_holder.find(".pp_details");$pp_details.width(t);detailsHeight=parseFloat($pp_details.css("marginTop"))+parseFloat($pp_details.css("marginBottom"));$pp_details=$pp_details.clone().addClass(settings.theme).width(t).appendTo(n("body")).css({position:"absolute",top:-1e4});detailsHeight+=$pp_details.height();detailsHeight=detailsHeight<=34?36:detailsHeight;$pp_details.remove();$pp_title=$pp_pic_holder.find(".ppt");$pp_title.width(t);titleHeight=parseFloat($pp_title.css("marginTop"))+parseFloat($pp_title.css("marginBottom"));$pp_title=$pp_title.clone().appendTo(n("body")).css({position:"absolute",top:-1e4});titleHeight+=$pp_title.height();$pp_title.remove();k=i+detailsHeight;rt=t;c=k+titleHeight+$pp_pic_holder.find(".pp_top").height()+$pp_pic_holder.find(".pp_bottom").height();l=t}function p(n){return n.match(/youtube\.com\/watch/i)||n.match(/youtu\.be/i)?"youtube":n.match(/vimeo\.com/i)?"vimeo":n.match(/\b.mov\b/i)?"quicktime":n.match(/\b.swf\b/i)?"flash":n.match(/\biframe=true\b/i)?"iframe":n.match(/\bajax=true\b/i)?"ajax":n.match(/\bcustom=true\b/i)?"custom":"#"==n.substr(0,1)?"inline":"image"}function w(){if(doresize&&"undefined"!=typeof $pp_pic_holder){if(scroll_pos=tt(),contentHeight=$pp_pic_holder.height(),contentwidth=$pp_pic_holder.width(),projectedTop=h/2+scroll_pos.scrollTop-contentHeight/2,projectedTop<0&&(projectedTop=0),contentHeight>h)return;$pp_pic_holder.css({top:projectedTop,left:s/2+scroll_pos.scrollLeft-contentwidth/2})}}function tt(){return self.pageYOffset?{scrollTop:self.pageYOffset,scrollLeft:self.pageXOffset}:document.documentElement&&document.documentElement.scrollTop?{scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft}:document.body?{scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft}:void 0}function ft(){h=n(window).height();s=n(window).width();"undefined"!=typeof $pp_overlay&&$pp_overlay.height(n(document).height()).width(s)}function et(){isSet&&settings.overlay_gallery&&"image"==p(pp_images[set_position])?(itemWidth=57,navWidth="facebook"==settings.theme||"pp_default"==settings.theme?50:30,itemsPerPage=Math.floor((e.containerWidth-100-navWidth)/itemWidth),itemsPerPage=itemsPerPage<pp_images.length?itemsPerPage:pp_images.length,totalPage=Math.ceil(pp_images.length/itemsPerPage)-1,0==totalPage?(navWidth=0,$pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").hide()):$pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").show(),galleryWidth=itemsPerPage*itemWidth,fullGalleryWidth=pp_images.length*itemWidth,$pp_gallery.css("margin-left",-(galleryWidth/2+navWidth/2)).find("div:first").width(galleryWidth+5).find("ul").width(fullGalleryWidth).find("li.selected").removeClass("selected"),goToPage=Math.floor(set_position/itemsPerPage)<totalPage?Math.floor(set_position/itemsPerPage):totalPage,n.prettyPhoto.changeGalleryPage(goToPage),$pp_gallery_li.filter(":eq("+set_position+")").addClass("selected")):$pp_pic_holder.find(".pp_content").unbind("mouseenter mouseleave")}function it(){if(settings.social_tools&&(facebook_like_link=settings.social_tools.replace("{location_href}",encodeURIComponent(location.href))),settings.markup=settings.markup.replace("{pp_social}",""),n("body").append(settings.markup),$pp_pic_holder=n(".pp_pic_holder"),$ppt=n(".ppt"),$pp_overlay=n("div.pp_overlay"),isSet&&settings.overlay_gallery){currentGalleryPage=0;toInject="";for(var t=0;t<pp_images.length;t++)pp_images[t].match(/\b(jpg|jpeg|png|gif)\b/gi)?(classname="",img_src=pp_images[t]):(classname="default",img_src=""),toInject+="<li class='"+classname+"'><a href='#'><img src='"+img_src+"' width='50' alt='' /><\/a><\/li>";toInject=settings.gallery_markup.replace(/{gallery}/g,toInject);$pp_pic_holder.find("#pp_full_res").after(toInject);$pp_gallery=n(".pp_pic_holder .pp_gallery");$pp_gallery_li=$pp_gallery.find("li");$pp_gallery.find(".pp_arrow_next").click(function(){return n.prettyPhoto.changeGalleryPage("next"),n.prettyPhoto.stopSlideshow(),!1});$pp_gallery.find(".pp_arrow_previous").click(function(){return n.prettyPhoto.changeGalleryPage("previous"),n.prettyPhoto.stopSlideshow(),!1});$pp_pic_holder.find(".pp_content").hover(function(){$pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeIn()},function(){$pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeOut()});itemWidth=57;$pp_gallery_li.each(function(t){n(this).find("a").click(function(){return n.prettyPhoto.changePage(t),n.prettyPhoto.stopSlideshow(),!1})})}settings.slideshow&&($pp_pic_holder.find(".pp_nav").prepend('<a href="#" class="pp_play">Play<\/a>'),$pp_pic_holder.find(".pp_nav .pp_play").click(function(){return n.prettyPhoto.startSlideshow(),!1}));$pp_pic_holder.attr("class","pp_pic_holder "+settings.theme);$pp_overlay.css({opacity:0,height:n(document).height(),width:n(window).width()}).bind("click",function(){settings.modal||n.prettyPhoto.close()});n("a.pp_close").bind("click",function(){return n.prettyPhoto.close(),!1});settings.allow_expand&&n("a.pp_expand").bind("click",function(){return n(this).hasClass("pp_expand")?(n(this).removeClass("pp_expand").addClass("pp_contract"),doresize=!1):(n(this).removeClass("pp_contract").addClass("pp_expand"),doresize=!0),g(function(){n.prettyPhoto.open()}),!1});$pp_pic_holder.find(".pp_previous, .pp_nav .pp_arrow_previous").bind("click",function(){return n.prettyPhoto.changePage("previous"),n.prettyPhoto.stopSlideshow(),!1});$pp_pic_holder.find(".pp_next, .pp_nav .pp_arrow_next").bind("click",function(){return n.prettyPhoto.changePage("next"),n.prettyPhoto.stopSlideshow(),!1});w()}f=jQuery.extend({hook:"rel",animation_speed:"fast",ajaxcallback:function(){},slideshow:5e3,autoplay_slideshow:!1,opacity:.8,show_title:!0,allow_resize:!0,allow_expand:!0,default_width:500,default_height:344,counter_separator_label:"/",theme:"pp_default",horizontal_padding:20,hideflash:!1,wmode:"opaque",autoplay:!0,modal:!1,deeplinking:!0,overlay_gallery:!0,overlay_gallery_max:30,keyboard_shortcuts:!0,changepicturecallback:function(){},callback:function(){},ie6_fallback:!0,markup:'<div class="pp_pic_holder"> \t\t\t\t\t\t<div class="ppt">&nbsp;<\/div> \t\t\t\t\t\t<div class="pp_top"> \t\t\t\t\t\t\t<div class="pp_left"><\/div> \t\t\t\t\t\t\t<div class="pp_middle"><\/div> \t\t\t\t\t\t\t<div class="pp_right"><\/div> \t\t\t\t\t\t<\/div> \t\t\t\t\t\t<div class="pp_content_container"> \t\t\t\t\t\t\t<div class="pp_left"> \t\t\t\t\t\t\t<div class="pp_right"> \t\t\t\t\t\t\t\t<div class="pp_content"> \t\t\t\t\t\t\t\t\t<div class="pp_loaderIcon"><\/div> \t\t\t\t\t\t\t\t\t<div class="pp_fade"> \t\t\t\t\t\t\t\t\t\t<a href="#" class="pp_expand" title="Expand the image">Expand<\/a> \t\t\t\t\t\t\t\t\t\t<div class="pp_hoverContainer"> \t\t\t\t\t\t\t\t\t\t\t<a class="pp_next" href="#">next<\/a> \t\t\t\t\t\t\t\t\t\t\t<a class="pp_previous" href="#">previous<\/a> \t\t\t\t\t\t\t\t\t\t<\/div> \t\t\t\t\t\t\t\t\t\t<div id="pp_full_res"><\/div> \t\t\t\t\t\t\t\t\t\t<div class="pp_details"> \t\t\t\t\t\t\t\t\t\t\t<div class="pp_nav"> \t\t\t\t\t\t\t\t\t\t\t\t<a href="#" class="pp_arrow_previous">Previous<\/a> \t\t\t\t\t\t\t\t\t\t\t\t<p class="currentTextHolder">0/0<\/p> \t\t\t\t\t\t\t\t\t\t\t\t<a href="#" class="pp_arrow_next">Next<\/a> \t\t\t\t\t\t\t\t\t\t\t<\/div> \t\t\t\t\t\t\t\t\t\t\t<p class="pp_description"><\/p> \t\t\t\t\t\t\t\t\t\t\t<div class="pp_social">{pp_social}<\/div> \t\t\t\t\t\t\t\t\t\t\t<a class="pp_close" href="#">Close<\/a> \t\t\t\t\t\t\t\t\t\t<\/div> \t\t\t\t\t\t\t\t\t<\/div> \t\t\t\t\t\t\t\t<\/div> \t\t\t\t\t\t\t<\/div> \t\t\t\t\t\t\t<\/div> \t\t\t\t\t\t<\/div> \t\t\t\t\t\t<div class="pp_bottom"> \t\t\t\t\t\t\t<div class="pp_left"><\/div> \t\t\t\t\t\t\t<div class="pp_middle"><\/div> \t\t\t\t\t\t\t<div class="pp_right"><\/div> \t\t\t\t\t\t<\/div> \t\t\t\t\t<\/div> \t\t\t\t\t<div class="pp_overlay"><\/div>',gallery_markup:'<div class="pp_gallery"> \t\t\t\t\t\t\t\t<a href="#" class="pp_arrow_previous">Previous<\/a> \t\t\t\t\t\t\t\t<div> \t\t\t\t\t\t\t\t\t<ul> \t\t\t\t\t\t\t\t\t\t{gallery} \t\t\t\t\t\t\t\t\t<\/ul> \t\t\t\t\t\t\t\t<\/div> \t\t\t\t\t\t\t\t<a href="#" class="pp_arrow_next">Next<\/a> \t\t\t\t\t\t\t<\/div>',image_markup:'<img id="fullResImage" src="{path}" />',flash_markup:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"><\/embed><\/object>',quicktime_markup:'<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"><\/embed><\/object>',iframe_markup:'<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"><\/iframe>',inline_markup:'<div class="pp_inline">{content}<\/div>',custom_markup:"",social_tools:'<div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet<\/a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"><\/script><\/div><div class="facebook"><iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href={location_href}&layout=button_count&show_faces=true&width=500&action=like&font&colorscheme=light&height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"><\/iframe><\/div>'},f);var e,b,k,rt,c,l,a,d=this,v=!1,h=n(window).height(),s=n(window).width();return doresize=!0,scroll_pos=tt(),n(window).unbind("resize.prettyphoto").bind("resize.prettyphoto",function(){w();ft()}),f.keyboard_shortcuts&&n(document).unbind("keydown.prettyphoto").bind("keydown.prettyphoto",function(t){if("undefined"!=typeof $pp_pic_holder&&$pp_pic_holder.is(":visible"))switch(t.keyCode){case 37:n.prettyPhoto.changePage("previous");t.preventDefault();break;case 39:n.prettyPhoto.changePage("next");t.preventDefault();break;case 27:settings.modal||n.prettyPhoto.close();t.preventDefault()}}),n.prettyPhoto.initialize=function(){return settings=f,"pp_default"==settings.theme&&(settings.horizontal_padding=16),theRel=n(this).attr(settings.hook),galleryRegExp=/\[(?:.*)\]/,isSet=galleryRegExp.exec(theRel)?!0:!1,pp_images=isSet?jQuery.map(d,function(t){if(-1!=n(t).attr(settings.hook).indexOf(theRel))return n(t).attr("href")}):n.makeArray(n(this).attr("href")),pp_titles=isSet?jQuery.map(d,function(t){if(-1!=n(t).attr(settings.hook).indexOf(theRel))return n(t).find("img").attr("alt")?n(t).find("img").attr("alt"):""}):n.makeArray(n(this).find("img").attr("alt")),pp_descriptions=isSet?jQuery.map(d,function(t){if(-1!=n(t).attr(settings.hook).indexOf(theRel))return n(t).attr("title")?n(t).attr("title"):""}):n.makeArray(n(this).attr("title")),pp_images.length>settings.overlay_gallery_max&&(settings.overlay_gallery=!1),set_position=jQuery.inArray(n(this).attr("href"),pp_images),rel_index=isSet?set_position:n("a["+settings.hook+"^='"+theRel+"']").index(n(this)),it(this),settings.allow_resize&&n(window).bind("scroll.prettyphoto",function(){w()}),n.prettyPhoto.open(),!1},n.prettyPhoto.open=function(i){return"undefined"==typeof settings&&(settings=f,pp_images=n.makeArray(arguments[0]),pp_titles=n.makeArray(arguments[1]?arguments[1]:""),pp_descriptions=n.makeArray(arguments[2]?arguments[2]:""),isSet=pp_images.length>1?!0:!1,set_position=arguments[3]?arguments[3]:0,it(i.target)),settings.hideflash&&n("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility","hidden"),ut(n(pp_images).size()),n(".pp_loaderIcon").show(),settings.deeplinking&&r(),settings.social_tools&&(facebook_like_link=settings.social_tools.replace("{location_href}",encodeURIComponent(location.href)),$pp_pic_holder.find(".pp_social").html(facebook_like_link)),$ppt.is(":hidden")&&$ppt.css("opacity",0).show(),$pp_overlay.show().fadeTo(settings.animation_speed,settings.opacity),$pp_pic_holder.find(".currentTextHolder").text(set_position+1+settings.counter_separator_label+n(pp_images).size()),"undefined"!=typeof pp_descriptions[set_position]&&""!=pp_descriptions[set_position]?$pp_pic_holder.find(".pp_description").show().html(unescape(pp_descriptions[set_position])):$pp_pic_holder.find(".pp_description").hide(),movie_width=parseFloat(t("width",pp_images[set_position]))?t("width",pp_images[set_position]):settings.default_width.toString(),movie_height=parseFloat(t("height",pp_images[set_position]))?t("height",pp_images[set_position]):settings.default_height.toString(),v=!1,-1!=movie_height.indexOf("%")&&(movie_height=parseFloat(n(window).height()*parseFloat(movie_height)/100-150),v=!0),-1!=movie_width.indexOf("%")&&(movie_width=parseFloat(n(window).width()*parseFloat(movie_width)/100-150),v=!0),$pp_pic_holder.fadeIn(function(){switch($ppt.html(settings.show_title&&""!=pp_titles[set_position]&&"undefined"!=typeof pp_titles[set_position]?unescape(pp_titles[set_position]):"&nbsp;"),imgPreloader="",skipInjection=!1,p(pp_images[set_position])){case"image":imgPreloader=new Image;nextImage=new Image;isSet&&set_position<n(pp_images).size()-1&&(nextImage.src=pp_images[set_position+1]);prevImage=new Image;isSet&&pp_images[set_position-1]&&(prevImage.src=pp_images[set_position-1]);$pp_pic_holder.find("#pp_full_res")[0].innerHTML=settings.image_markup.replace(/{path}/g,pp_images[set_position]);imgPreloader.onload=function(){e=o(imgPreloader.width,imgPreloader.height);y()};imgPreloader.onerror=function(){alert("Image cannot be loaded. Make sure the path is correct and image exist.");n.prettyPhoto.close()};imgPreloader.src=pp_images[set_position];break;case"youtube":e=o(movie_width,movie_height);movie_id=t("v",pp_images[set_position]);""==movie_id&&(movie_id=pp_images[set_position].split("youtu.be/"),movie_id=movie_id[1],movie_id.indexOf("?")>0&&(movie_id=movie_id.substr(0,movie_id.indexOf("?"))),movie_id.indexOf("&")>0&&(movie_id=movie_id.substr(0,movie_id.indexOf("&"))));movie="http://www.youtube.com/embed/"+movie_id;movie+=t("rel",pp_images[set_position])?"?rel="+t("rel",pp_images[set_position]):"?rel=1";settings.autoplay&&(movie+="&autoplay=1");toInject=settings.iframe_markup.replace(/{width}/g,e.width).replace(/{height}/g,e.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);break;case"vimeo":e=o(movie_width,movie_height);movie_id=pp_images[set_position];var i=movie_id.match(/http(s?):\/\/(www\.)?vimeo.com\/(\d+)/);movie="http://player.vimeo.com/video/"+i[3]+"?title=0&byline=0&portrait=0";settings.autoplay&&(movie+="&autoplay=1;");vimeo_width=e.width+"/embed/?moog_width="+e.width;toInject=settings.iframe_markup.replace(/{width}/g,vimeo_width).replace(/{height}/g,e.height).replace(/{path}/g,movie);break;case"quicktime":e=o(movie_width,movie_height);e.height+=15;e.contentHeight+=15;e.containerHeight+=15;toInject=settings.quicktime_markup.replace(/{width}/g,e.width).replace(/{height}/g,e.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,pp_images[set_position]).replace(/{autoplay}/g,settings.autoplay);break;case"flash":e=o(movie_width,movie_height);flash_vars=pp_images[set_position];flash_vars=flash_vars.substring(pp_images[set_position].indexOf("flashvars")+10,pp_images[set_position].length);filename=pp_images[set_position];filename=filename.substring(0,filename.indexOf("?"));toInject=settings.flash_markup.replace(/{width}/g,e.width).replace(/{height}/g,e.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,filename+"?"+flash_vars);break;case"iframe":e=o(movie_width,movie_height);frame_url=pp_images[set_position];frame_url=frame_url.substr(0,frame_url.indexOf("iframe")-1);toInject=settings.iframe_markup.replace(/{width}/g,e.width).replace(/{height}/g,e.height).replace(/{path}/g,frame_url);break;case"ajax":doresize=!1;e=o(movie_width,movie_height);doresize=!0;skipInjection=!0;n.get(pp_images[set_position],function(n){toInject=settings.inline_markup.replace(/{content}/g,n);$pp_pic_holder.find("#pp_full_res")[0].innerHTML=toInject;y()});break;case"custom":e=o(movie_width,movie_height);toInject=settings.custom_markup;break;case"inline":myClone=n(pp_images[set_position]).clone().append('<br clear="all" />').css({width:settings.default_width}).wrapInner('<div id="pp_full_res"><div class="pp_inline"><\/div><\/div>').appendTo(n("body")).show();doresize=!1;e=o(n(myClone).width(),n(myClone).height());doresize=!0;n(myClone).remove();toInject=settings.inline_markup.replace(/{content}/g,n(pp_images[set_position]).html())}imgPreloader||skipInjection||($pp_pic_holder.find("#pp_full_res")[0].innerHTML=toInject,y())}),!1},n.prettyPhoto.changePage=function(t){currentGalleryPage=0;"previous"==t?(set_position--,set_position<0&&(set_position=n(pp_images).size()-1)):"next"==t?(set_position++,set_position>n(pp_images).size()-1&&(set_position=0)):set_position=t;rel_index=set_position;doresize||(doresize=!0);settings.allow_expand&&n(".pp_contract").removeClass("pp_contract").addClass("pp_expand");g(function(){n.prettyPhoto.open()})},n.prettyPhoto.changeGalleryPage=function(n){"next"==n?(currentGalleryPage++,currentGalleryPage>totalPage&&(currentGalleryPage=0)):"previous"==n?(currentGalleryPage--,currentGalleryPage<0&&(currentGalleryPage=totalPage)):currentGalleryPage=n;slide_speed="next"==n||"previous"==n?settings.animation_speed:0;slide_to=currentGalleryPage*itemsPerPage*itemWidth;$pp_gallery.find("ul").animate({left:-slide_to},slide_speed)},n.prettyPhoto.startSlideshow=function(){"undefined"==typeof a?($pp_pic_holder.find(".pp_play").unbind("click").removeClass("pp_play").addClass("pp_pause").click(function(){return n.prettyPhoto.stopSlideshow(),!1}),a=setInterval(n.prettyPhoto.startSlideshow,settings.slideshow)):n.prettyPhoto.changePage("next")},n.prettyPhoto.stopSlideshow=function(){$pp_pic_holder.find(".pp_pause").unbind("click").removeClass("pp_pause").addClass("pp_play").click(function(){return n.prettyPhoto.startSlideshow(),!1});clearInterval(a);a=void 0},n.prettyPhoto.close=function(){$pp_overlay.is(":animated")||(n.prettyPhoto.stopSlideshow(),$pp_pic_holder.stop().find("object,embed").css("visibility","hidden"),n("div.pp_pic_holder,div.ppt,.pp_fade").fadeOut(settings.animation_speed,function(){n(this).remove()}),$pp_overlay.fadeOut(settings.animation_speed,function(){settings.hideflash&&n("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility","visible");n(this).remove();n(window).unbind("scroll.prettyphoto");u();settings.callback();doresize=!0;b=!1;delete settings}))},!pp_alreadyInitialized&&i()&&(pp_alreadyInitialized=!0,hashIndex=i(),hashRel=hashIndex,hashIndex=hashIndex.substring(hashIndex.indexOf("/")+1,hashIndex.length-1),hashRel=hashRel.substring(0,hashRel.indexOf("/")),setTimeout(function(){n("a["+f.hook+"^='"+hashRel+"']:eq("+hashIndex+")").trigger("click")},50)),this.unbind("click.prettyphoto").bind("click.prettyphoto",n.prettyPhoto.initialize)}}(jQuery);var pp_alreadyInitialized=!1