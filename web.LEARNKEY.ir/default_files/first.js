function GetFileSize(n,t){var f,i,e,r,u;if($(n).unbind(),$(n).bind("change",function(){this.files[0].size/2024>t?(t=t/2024,$(".Err").html("حجم فایل باید کمتر از 2 مگابایت باشد!"),n.value=""):$(".Err").html("")}),f=[".jpg",".jpeg",".bmp",".gif",".png"],n.type=="file"&&(i=n.value,i.length>0)){for(e=!1,r=0;r<f.length;r++)if(u=f[r],i.substr(i.length-u.length,u.length).toLowerCase()==u.toLowerCase()){e=!0;break}if(e)$(".Err").html("");else return $(".Err").html("پسوند عکس مجاز نمی باشد!"),n.value="",!1}return!0}function DoSubmit(){return $(".amount").each(function(){$(this).val($(this).val().split(",").join(""))}),!0}$("#Zon").multipleSelect({onOpen:function(){$eventResult.text("Select opened!")},onClose:function(){$eventResult.text("Select closed!")},onCheckAll:function(){$eventResult.text("Check all clicked!")},onUncheckAll:function(){$eventResult.text("Uncheck all clicked!")},onFocus:function(){$eventResult.text("focus!")},onBlur:function(){$eventResult.text("blur!")},onOptgroupClick:function(n){var t=$.map(n.children,function(n){return n.value}).join(", ");$eventResult.text("Optgroup "+n.label+" "+(n.checked?"checked":"unchecked")+": "+t)},onClick:function(n){$eventResult.text(n.label+"("+n.value+") "+(n.checked?"checked":"unchecked"))}});var elem=$("#Offers ul");$("#viewcontrols a").on("click",function(){$(this).hasClass("gridview")?elem.fadeOut(1e3,function(){$("a").removeClass("active");$(".gridview").addClass("active");$("#Offers > ul").removeClass("list").addClass("grid");$("#viewcontrols").removeClass("view-controls-list").addClass("view-controls-grid");$("#Offers > ul").addClass("grid-fluid-3");$("#Offers > ul").addClass("automatch");$("#Offers > ul > li").removeClass("offer");$("#Offers > ul li").addClass("bbb");$("#Offers > ul > li:nth-child(3n)").addClass("omega");$("#Offers div.left").addClass("none");$("#Offers div.right").addClass("none");$("#Offers div.offer").removeClass("none");elem.fadeIn(1e3)}):$(this).hasClass("listview")&&elem.fadeOut(1e3,function(){$("a").removeClass("active");$(".listview").addClass("active");$("#Offers > ul").removeClass("grid").addClass("list");$("#viewcontrols").removeClass("view-controls-grid").addClass("view-controls-list");$("#Offers > ul").removeClass("grid-fluid-3");$("#Offers > ul").removeClass("automatch");$("#Offers > ul > li").addClass("offer");$("#Offers > ul > li:nth-child(3n)").removeClass("omega");$("#Offers div.left").removeClass("none");$("#Offers div.right").removeClass("none");$("#Offers div.offer").addClass("none");elem.fadeIn(1e3)})});$(document).ready(function(){$(".amount").keyup(function(n){n.which>=37&&n.which<=40||$(this).val(function(n,t){return t.replace(/\D/g,"").replace(/\B(?=(\d{3})+(?!\d))/g,",")})})})