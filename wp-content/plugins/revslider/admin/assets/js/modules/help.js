/*!
 * REVOLUTION 6.0.0 HELP JS
 * @version: 1.0 (01.07.2019)
 * @author ThemePunch
*/
jQuery(function(){if("undefined"!=typeof jQuery){var e,t,s,a,i,r,l,o,n,d,c,p,h,u,f,_,m,v,y,g,b,k,w,j,Q,S,C,R,x,T,O,V,H,G,P,N,A,I,L,q,E,F,D,M,z,J,W,B=":checked",U=new RegExp("layerinput|actioninput"),X=new RegExp("sliderinput|navstyleinput"),K=new RegExp("slideinput|added_slide_transition"),Y="*[data-r], *[data-select], *[data-helpkey], .ddTP, .revbuilder-colorpicker, .tponoffwrap, .fake_on_button, .added_slide_transition, .lal_group_member",Z=".frame_list_title, .intelligent_buttons";RVS.DOC.on("click","#help_menu .tponoffwrap",function(e){e.stopImmediatePropagation(),void 0!==RVS.ENV.plugin_url&&"undefined"!=typeof RVS&&"undefined"!=typeof tpGS&&(F?te():$())}),F?te():$(),showhidehelpdata.checked=!0,RVS.F.turnOnOffVisUpdate({btn:showhidehelpdata,input:showhidehelpdata}),jQuery(".help_wrap").on("mouseenter",function(){tpGS.gsap.set("#help_mode_modal",{inset:50+help_menu.clientHeight+"px 100% auto auto"}),G=!0,j&&(I=!0,ie())}).on("mouseleave",function(){tpGS.gsap.set("#help_mode_modal",{inset:50+help_menu.clientHeight+"px 100% auto auto"}),G=!1}),HelpGuide.toggleHelpAddOn=function(e,t){var s=t?"removeClass":"addClass";HelpGuide.allHelpPaths.find('.help-directory-menu[data-path="'+e+'"]')[s]("help-hide-addon"),oe(),D.trigger("click")},HelpGuide.extendHelpAddOns=function(s,i){for(var r=s.length,l=0;l<r;l++){var o=s[l];if(HelpGuide.verifyObject(o))for(var n,d,c,p=o.slug,h=0;h<3;h++)n=o[c=0===h?"slider":1===h?"slide":"layer"],HelpGuide.verifyObject(n)&&((d={})[p]=n,i?(e="",t="extension",re(d,""),jQuery('.help-directory-menu[data-path="'+c+'_settings"]').find('.help-directory-menu[data-path="addons"]').append(e)):jQuery.extend(!0,a.editor_settings[c+"_settings"].addons,d))}}}else console.log("jQuery not available");function $(){jQuery("head").append('<link rel="stylesheet" type="text/css" href="'+RVS.ENV.plugin_url+'admin/assets/css/help.css" />'),RVS.F.ajaxRequest("get_help_directory",{},function(t){var n;if(t.success){try{n=JSON.stringify(t.data),n=JSON.parse(n)}catch(e){n=!1}n?(r=n.translations,a=n.helpindex,F=!0,function(){win=jQuery(window),l=jQuery("body");var t='<div id="help_mode_modal"><div class="help-mode-title"><span id="help_mode_title_wrap" class="help-icon-default"><i class="material-icons">touch_app</i><i class="material-icons">settings</i><i class="material-icons">gamepad</i><i class="material-icons">burst_mode</i><i class="material-icons">layers</i><span id="help_mode_title">'+r.helpMode+'</span></span><span id="help_mode_main_title">'+r.instructions+'</span><div id="help_mode_video_wrap"><video id="help_mode_video" width="520" height="292" muted loop playsinline><source src="'+RVS.ENV.plugin_url+'/admin/assets/videos/hover_tutorial.mp4" type="video/mp4" /></video></div></div><div class="help-mode-description"><div class="help-mode-section"><div id="help_mode_description"></div></div><div id="help-mode-buttons" class="help-mode-section"><div id="help_mode_documentation" class="help-mode-button"><i class="material-icons">library_books</i> '+r.viewDocs+'</div><div id="help_mode_option" class="help-mode-button"><i class="material-icons">near_me</i><i class="material-icons">settings</i><i class="material-icons">gamepad</i><i class="material-icons">burst_mode</i><i class="material-icons">layers</i> '+r.showOption+'</div><div class="tp-clearfix"></div></div></div><div id="help_mode_search_wrap"><div id="help_mode_search" class="help-mode-section"><input id="help_search_input" type="text" placeholder="'+r.search+'\'><span id=\'help_input_clear\'><i class=\'material-icons\'>close</i></span></div><div id="help_search_results"><div class="help-results-container"><div id="help-options-wrap" class="help-results-wrap"><div id="help_options_results" class="help-results"></div></div></div><div class="help-results-container"><div id="help-faqs-wrap" class="help-results-wrap"><div id="help_faq_results" class="help-results"></div></div></div><div class="tp-clearfix"></div></div></div><span id="help_modal_close"><i class="material-icons help-no-drag">close</i></span></div>';jQuery(t).prependTo(jQuery("#the_right_toolbar")),s=jQuery("#help_mode_title"),v=jQuery("#help_mode_title_wrap"),H=jQuery("#help_mode_description"),jQuery("#help-mode-buttons"),C=jQuery("#help_faq_results"),q=jQuery("#help_search_results"),E=jQuery("#help_options_results"),jQuery("#help_mode_search"),W=jQuery("#help_search_input").on("focus",ne).on("keyup",Pe),D=jQuery("#help_input_clear").on("click",function(){W.val("").trigger("keyup")}),s.data("origtext",s.html()),o=jQuery("#help_mode_modal").draggable({cancel:".help-no-drag, .help-mode-description, #help_mode_search_wrap"}).on("mouseenter",be).on("mouseleave",ke),jQuery("#help_modal_close").on("click",function(){l.removeClass("help-mode-active")}),Q=jQuery("#help_mode_documentation").on("click",function(){jQuery(".help-input-focus").removeClass("help-input-focus"),window.open(this.dataset.link)}),N=jQuery("#help_mode_option").on("click",Ge),J=jQuery(".help-results-wrap").RSScroll({wheelPropagation:!0,suppressScrollX:!0,minScrollbarLength:100}),y=jQuery("#help_mode_video"),b=jQuery("#help_mode_video_wrap"),z=jQuery(".help-mode-description"),function(){for(var e=[[".fake_on_button","slider","size.custom.d"],['*[data-r="source.woo.types"]',"slider","source.post.types"],['*[data-r="source.woo.category"]',"slider","source.post.category"],['*[data-r="source.woo.sortBy"]',"slider","source.post.sortBy"],['*[data-r="source.woo.sortDirection"]',"slider","source.post.sortDirection"],['*[data-r="source.woo.maxProducts"]',"slider","source.post.maxPosts"],['*[data-r="source.woo.excerptLimit"]',"slider","source.post.excerptLimit"],["#row_column_structure","layer","row_column_structure"],[".colselector label_bigicon","layer","row_column_structure"],[".layer_rowbreak_icons","layer","group.columnbreakat"],[".modal_hor_selector","slider","modal.horizontal"],[".modal_ver_selector","slider","modal.vertical"]],t=0;t<e.length;t++)jQuery(e[t][0]).attr({"data-helproot":e[t][1],"data-helpkey":e[t][2]})}(),function(){HelpGuide.addOnsHelp.length&&HelpGuide.extendHelpAddOns(HelpGuide.addOnsHelp);e="",i=0,re(a,' class="help-directory-top"'),HelpGuide.allHelpPaths=jQuery(e),oe()}(),w=[],x=[],jQuery(".rbm_close").each(function(e){x[e]=jQuery(this)}),d=jQuery("#rbm_slider_api"),S=jQuery("#layeraction_list"),T=jQuery("#rbm_layer_action"),c=jQuery("#add_layer_toolbar_wrap"),A=jQuery("#the_right_toolbar_inner"),g=jQuery("#help_mode_main_title"),function(){for(var e,t,s,i,r=0;r<3;r++)for(t in i=0===r?"slider":1===r?"slide":"layer",e=a.editor_settings[i+"_settings"].addons)e.hasOwnProperty(t)&&(t=t.replace("_addon",""),s="revslider-"+t+"-addon",RVS.SLIDER.settings.addOns.hasOwnProperty(s)&&RVS.SLIDER.settings.addOns[s].enable||HelpGuide.deactivate(t+"_addon"))}(),te()}()):console.log("help directory error")}else console.log("help directory error")})}function ee(){RVS.WIN.trigger("resize")}function te(){clearTimeout(R),j?(clearTimeout(P),clearTimeout(f),clearTimeout(p),clearTimeout(n),j=!1,I=!1,M=!1,RVS.WIN.off(".helpguide"),l.off(".helpguide").removeClass("help-mode-activated help-mode-active"),jQuery(".help-input-focus").removeClass("help-input-focus"),R=setTimeout(se,500)):(j=!0,D.trigger("click"),tpGS.gsap.set(o,{top:50+help_menu.clientHeight,left:"auto",right:"100%",bottom:"auto",height:"auto"}),Q.hide(),N.hide(),z.hide(),s.removeClass(fe).addClass("help-icon-default").html(s.data("origtext")),l.addClass("help-mode-activated help-mode-active").on("mouseenter.helpguide",Y,ye).on("mouseenter.helpguide",Z,ve).on("mouseleave.helpguide",Y+","+Z,ge).on("mouseover.helpguide",".toolbar_selector_icons",ae).on("mouseout.helpguide",".toolbar_selector_icons",ie),l.on("click.helpguide",".help-button",he).on("mouseenter.helpguide",".help-hover",Qe),f=setTimeout(we,3e3),RVS.WIN.on("resize.helpguide",ue),ue(),se(!0)),clearTimeout(O),O=setTimeout(ee,100)}function se(e){y&&y.length&&(e?(g.text(r.instructions),b.show(),y[0].currentTime=0,y[0].play().then(function(){L=!0}).catch(function(e){L=!1}),y.show()):(g.text(r.selectresult),b.hide(),L&&y[0].pause(),y.hide()))}function ae(){(I=l.hasClass("help-mode-active"))&&(clearTimeout(p),l.removeClass("help-mode-active"))}function ie(){I&&(l.addClass("help-mode-active"),clearTimeout(p),me())}function re(s,a){var l=Object.keys(s),o=l.length,n=o-1;e+="<ul"+a+">";for(var d=0;d<o;d++){var c=l[d],p=s[c],h=HelpGuide.verifyObject(p)||"addons"===c;if(h){var u=h&&p.helpPath;if(u){var f="",_="",m="",v="",y="",g='<i class="material-icons">keyboard_arrow_right</i>',b=!0!==u?r.docs:r.tutorial;if(p.description&&(y='<span class="help-text">'+p.description+"</span>"),p.article&&(_='<span class="basic_action_button longbutton help-article" data-article="'+p.article+'"><i class="material-icons">assignment</i>'+b+"</span>"),p.section)if(Array.isArray(p.section)){m="";for(var k=p.section.length,w=0;w<k;w++)m+='<span class="help-section">'+p.section[w].replace(/\-\>/g,g)+"</span>"}else m='<span class="help-section">'+p.section.replace(/\-\>/g,g)+"</span>";if(p.highlight&&HelpGuide.verifyObject(p.highlight)){var j="",Q="",S="",C="",R=p.dependency_id?' id="revhelp_'+p.dependency_id+'"':"";(v=p.highlight).menu&&(j=' data-menu="'+v.menu+'"'),v.modal&&(Q=' data-modal="'+v.modal+'"'),v.focus&&(S=' data-focus="'+v.focus+'"'),v.scrollTo&&(C=' data-scrollto="'+v.scrollTo+'"'),v.dependencies&&Array.isArray(v.dependencies)&&(C+=" data-dependencies='"+JSON.stringify(v.dependencies)+"'"),v="<span"+R+' class="basic_action_button longbutton help-option"'+j+C+S+Q+'><i class="material-icons">settings</i>'+r.option+"</span>"}if(d===n){for(var x=0;x<i;x++)f+="</li>";i=0}e+='<li class="help-directory-menu help-directory-target" data-path="'+c+'"><div class="help-directory-item"><i class="material-icons">'+t+"</i>"+p.title+'</div><ul><li><div class="help-description">'+m+y+_+v+"</div></li></ul></li>"+f}else{switch(c){case"general_how_to":t="help_outline";break;case"slider_settings":t="settings";break;case"navigation_settings":t="gamepad";break;case"slide_settings":t="burst_mode";break;case"layer_settings":t="layers"}var T=c.replace(/\_/g," ").replace(/\b\w/g,function(e){return e.toUpperCase()});e+='<li class="help-directory-menu" data-path="'+c+'"><div class="help-directory-item"><i class="material-icons help-arrow-down">folder</i><i class="material-icons help-arrow-up">folder_open</i><span>'+T+"</span></div>",i++,re(p,"")}}}e+="</ul>"}function le(){var e=jQuery(this);return e.html()?e.children("li").not(".help-hide-addon").length:(e.remove(),!1)}function oe(){jQuery('.help-directory-menu[data-path="addons"]').each(function(){var e=jQuery(this);e.children("ul").filter(le).length?e.show():e.hide()})}function ne(){w=[],HelpGuide.allHelpPaths.find(".help-directory-target").each(function(e){for(var t="",s=jQuery(this).parents(".help-directory-menu").not(".help-hide-addon").toArray().reverse(),a=s.length,i=0;i<a;i++)t+=s[i].dataset.path+".";w[w.length]=t+this.dataset.path})}function de(e,t){if("string"==typeof t&&(t=t.split(".")),t.length>1){var s=t.shift();return!!e.hasOwnProperty(s)&&de(e[s],t)}return!!e.hasOwnProperty(t[0])&&e[t[0]]}function ce(e,t,s){if(!t)return!1;if(s||(s=function(e,t){var s=e.attr("class");if(s){if(-1!==s.search(X))return function(e,t){return e.closest(".slider_general_collector").length?"slider":"nav"}(e);if(-1!==s.search(K)||-1!==t.search("#slide#"))return"slide";if(-1!==s.search(U)||-1!==t.search("#layer#"))return"layer"}return e.closest("#rbm_layer_action").length?"layer":e.closest(".mode__sliderlayout").length?"slider":e.closest(".mode__navlayout").length?"nav":e.closest(".mode__slidecontent").length?"layer":!!e.closest(".mode__slidelayout").length&&"slide"}(e,t)),!s)return!1;var i=-1!==t.indexOf("actions.")&&"actions";if("actions"===i&&(i=function(e){return-1!==e.search(/panorama|whiteboard|beforeafter/)?"addons":"actions"}(t)),0===t.indexOf("#frame#.")&&(i=function(e){return-1!==e.search("explode")&&"addons"}(t)),i||(i="slider"!==s?s:"general",i+="_submodule_trigger",i=jQuery("."+i+".selected").attr("id")),i){"nav"===s&&(s="navigation"),i=function(e,t){switch(t){case"progress":if("navigation_settings"===e)return"progress_bar";break;case"prev_image":return"preview_image";case"holiday_snow":return"snow"}return t}(s+="_settings",i=RVS.F.trim(i).toLowerCase().replace(".","").replace("&","and").replace(/\-/g,"_").replace(/\s/g,"_"));var r=a.editor_settings[s]&&a.editor_settings[s][i];if(r||(i="addons",r=a.editor_settings[s]&&a.editor_settings[s][i]),r){if(u="",function e(t,s,a){if(!u){var i,r=t.helpPath;if(r){i=(r=r.split(",")).length;for(var l=0;l<i;l++)if(RVS.F.trim(r[l])===a){u=s;break}if(u)return}var o=Object.keys(t);i=o.length;for(var n=0;n<i;n++)HelpGuide.verifyObject(t[o[n]])&&e(t[o[n]],s+"."+o[n],a)}}(a.editor_settings[s][i],"",t),u)return["editor_settings."+s+"."+i+u,a.editor_settings[s][i],u];if(t.indexOf("addOns.tpack")>=0){var l=t.split(".");return["editor_settings.slide_settings.addons.transitionpack."+(l=l[l.length-1]),a.editor_settings.slide_settings.addons.transitionpack,"."+l]}}}return!1}function pe(e,t,s){var a='<span class="help-button',i="";switch(s&&(a+=" help-button-"+s),a+='" data-path="'+t+'">',s){case"slider":i='<i class=" material-icons">settings</i>';break;case"nav":i='<i class=" material-icons">gamepad</i>';break;case"slide":i='<i class=" material-icons">burst_mode</i>';break;case"layer":i='<i class=" material-icons">layers</i>';break;case"doc":i='<i class=" material-icons">library_books</i>';break;default:i='<i class=" material-icons">help_outline</i>'}return a+=i+"<span>"+e+"</span></span>"}function he(){var e=this.dataset.path;_e(de(a,e),e)}function ue(e,t){var s=Math.max(E.height(),C.height()),a=Math.min(RVS.WIN.height()/3,s);J.height(a),J[0].scrollTop=0,J[1].scrollTop=0,J.RSScroll("update")}function fe(e,t){return(t.match(/(^|\s)help-\icon-\S+/g)||[]).join(" ")}function _e(e,t){var a=e.highlight,i=e.buttonTitle||e.title;t="general_how_to"!==(t=t.split("."))[0]?t[1].replace("_settings",""):"faq",g.text(i),s.html(t+" "+r.options),v.removeClass(fe).addClass("help-icon-"+t),H.html(e.description),z.show(),Q.attr("data-link",e.article).css("display","inline-block"),N.removeAttr("data-menu data-modal data-scrollto data-focus data-dependencies").removeClass(fe).addClass("help-icon-"+t).css("display","inline-block"),a?(a.menu&&N.attr("data-menu",a.menu),a.modal&&N.attr("data-modal",a.modal),a.scrollTo&&N.attr("data-scrollto",a.scrollTo),a.focus&&N.attr("data-focus",a.focus),a.dependencies&&Array.isArray(a.dependencies)&&N.attr("data-dependencies",JSON.stringify(a.dependencies))):N.hide(),l.addClass("help-mode-active")}function me(){p=setTimeout(function(){h||_||G||l.removeClass("help-mode-active")},3e3)}function ve(){var e;if(this.className&&-1!==this.className.search("frame_list_title")){var t=jQuery(this).closest(".keyframe_liste").attr("data-frame");if(!t)return;switch(t=t.replace("frame_","")){case"0":e="animation.in.from";break;case"1":e="animation.in.to";break;case"999":e="animation.out.to";break;default:e="animation.keyframe.to"}}else e=this.dataset.evt;this.dataset.helpkey=e,ye.call(this)}function ye(){var e=jQuery(this);if(!e.hasClass("opensettingstrigger")&&!e.hasClass("formcontainer")){clearTimeout(f),clearTimeout(n),jQuery(".help-input-focus").removeClass("help-input-focus");var t,s=this.dataset.helpkey||this.dataset.r;if(s||(s=(t=(t=e).attr("data-select")?jQuery(t.attr("data-select")):t.hasClass("ddTP")?t.prev("select"):t.hasClass("revbuilder-colorpicker")?t.find(".revbuilder-cpicker-component"):t.find("input[data-r]")).attr("data-helpkey")||t.attr("data-r")||""),t&&t.length||(t=e),s=function(e,t){return-1!==t.search("parallax.levels")&&3===(t=t.split(".")).length?t[0]+"."+t[1]:-1!==t.search("info.params")&&4===(t=t.split(".")).length?t[0]+"."+t[1]+"."+t[3]:e.hasClass("added_slide_transition")?"added_slide_transition":-1===t.search(/nav\.|bullets\./)?t:e.closest("#sr_bullets_styles_fieldset, #sr_tabs_styles_fieldset").length?-1===t.search("def")?"navigation.styles":"navigation.styles.default":e.closest("#sl_bullets_styles_fieldset, #sl_tabs_styles_fieldset").length?-1===t.search("def")?"navigation.styles":"navigation.styles.default":t}(t,s)){var a=s;"radio"===this.type&&(a+="."+this.value);var i=ce(t,a,e.attr("data-helproot"));(i||("radio"===this.type&&(i=ce(t,s,e.attr("data-helproot"))),i))&&(m=!0,M=!0,n=setTimeout(function(){if(m)if(clearTimeout(p),D.trigger("click"),_=!0,se(),_e(de(i[1],i[2].substr(1)),i[0]),e.hasClass("revbuilder-colorpicker")||e.hasClass("tponoffwrap")){var s=e.closest(".tponoffwrap");s.length?s.addClass("help-input-focus"):e.addClass("help-input-focus")}else e.attr("class")&&-1===e.attr("class").search(/bg_alignselector|layer_hor_selector|layer_ver_selector|layer_content_hor_selector|layer_content_ver_selector/)?t.addClass("help-input-focus"):e.addClass("help-input-focus")},500))}}}function ge(){m=!1,_=!1,me()}function be(){clearTimeout(p),h=!0}function ke(){h=!1,M&&!G&&me()}function we(){h||G||(M=!0,ke())}function je(){jQuery(this).removeClass(function(e,t){return(t.match(/(^|\s)help-\hover-\S+/g)||[]).join(" ")})}function Qe(){V&&(V=!1,l.off(".helpguidehover"),jQuery(".help-hover").removeClass("help-hover").each(je))}function Se(){l.off(".helpguidehover").one("click.helpguidehover",Qe)}function Ce(e,t){var s;clearTimeout(k),Qe(),"layers"===e?(t||(t="text"),c.addClass("help-hover"),c.addClass("help-hover-"+t)):(s=c.prev().addClass("help-hover"),"slideorder"===e?s.addClass("help-hover-slideorder"):"staticlayers"===e&&s.addClass("help-hover-staticlayers")),V=!0,k=setTimeout(Se,100)}function Re(){var e=jQuery(this);e.hasClass("tponoff")?e=e.closest(".tponoffwrap"):e.hasClass("revbuilder-cpicker-component")&&(e=e.closest(".revbuilder-colorpicker")),e.addClass("help-input-focus")}function xe(e){var t,s,a,i,r,l,o,n,d,c,p;switch((e=e.split("::"))[0]){case"layerselected":if(2===e.length&&(p=e[1]),p)for(n=p.split("||"),c="",-1!==(p=n[0]).search("{{")&&(c=" .tp-"+(o=(p=p.split("{{"))[1].split("}}")[0]),p=o),a=n.length,i="",t=0;t<a;t++)t>0&&(i+=", "),s=n[t],c&&(s=s.split("{{")[0]),i+="._lc_type_"+s+c;else i="._lc_";try{l=jQuery(i)}catch(e){l=!1}l&&l.length?(l.hasClass("_lc_content_")&&(l=l.closest("._lc_")),(r=l.filter(".selected")).length||(r=l.eq(0).trigger("click")),d=function(e){for(var t=e[0].className.split(" "),s=t.length;s--;)if(-1!==t[s].search("_lc_type_"))return t[s].replace("_lc_type_","");return!1}(r)):Ce("layers",p);break;case"addlayer":Ce("layers","text");break;case"addslide":Ce("slides");break;case"slideorder":Ce("slideorder");break;case"staticlayers":Ce("staticlayers");break;default:try{jQuery(e[0]).trigger("click")}catch(e){}}return d}function Te(e){return"true"===e||"on"===e||"false"!==e&&"off"!==e&&e}function Oe(e){return"#layer#"===e&&void 0!==RVS.selLayers&&Array.isArray(RVS.selLayers)&&RVS.selLayers.length?void 0!==RVS.S.clickedLayer?lastClickedLayer:RVS.selLayers[0].toString():"#slide#"===e&&void 0!==RVS.S.slideId?RVS.S.slideId:"#frame#"===e&&void 0!==RVS.S.keyFrame?RVS.S.keyFrame:"#action#"===e&&void 0!==RVS.S.actionIdx?RVS.S.actionIdx:e}function Ve(e){if(!(e=JSON.parse(e))||!Array.isArray(e))return!1;for(var t,s,a,i,r,l,o,n,d=e.length,c=0;c<d;c++)if(a=e[c],HelpGuide.verifyObject(a)){if(a.dependency&&a.dependency!==t)continue;for(r=a.path.split("."),i=RVS.SLIDER,l=r.length,s=!1,n=0;n<l;n++){if(o=Oe(r[n]),!i.hasOwnProperty(o))return!0;i=i[o]}if(t=i=Te(i),"string"==typeof a.value&&-1!==a.value.search("::")){var p=a.value.split("::");for(l=p.length,n=0;n<l;n++)if(p[n]===i){s=!0;break}}else a.value===i&&(s=!0);if(!s)return a.target&&(B="[value='"+a.target+"']"),Ge.call(HelpGuide.allHelpPaths.find("#revhelp_"+a.option)),!0}else t=xe(e[c]);return!1}function He(){try{this.trigger("click")}catch(e){}}function Ge(e){e&&e.stopImmediatePropagation(),jQuery(".help-input-focus").removeClass("help-input-focus");var t=jQuery(this),s=t.attr("data-modal"),a=s&&"actions"===s,i=t.attr("data-dependencies");if(a||!i||!Ve(i)){var r,l,o,n=t.attr("data-menu"),c=t.attr("data-focus"),p=t.attr("data-scrollto");s||jQuery.each(x,He),n&&function(e){for(var t,s=(e=e.split(",")).length,a=0;a<s;a++)(t=jQuery(RVS.F.trim(e[a]))).hasClass("selected")||("gst_layer_5"===t.attr("id")?xe("layerselected")&&!T.is(":visible")&&t.trigger("click"):"gst_sl_11"===t.attr("id")?(jQuery(".emc_toggle_wrap").removeClass("open"),d.is(":visible")||t.trigger("click")):t.trigger("click"))}(n),c&&function(e){jQuery(".help-input-focus").removeClass("help-input-focus"),jQuery(".lal_group_member.selected").removeClass("selected"),e=e.replace("*wildcard*",B),B=":checked";var t,s,a,i=-1!==e.search("{first}");-1!==e.search("{frame}")?(s=!0,e=e.replace("{frame}","")):-1!==e.search("{keyframe}")&&(t=!0,e=e.replace("{keyframe}","")),i&&(e=e.replace("{first}",""));try{a=jQuery(e)}catch(e){return}t&&!a.length&&(a=jQuery(".add_frame_after").first()),(s||t)&&a.closest(".keyframe_liste").css("z-index","29"),i?a.eq(0).addClass("help-input-focus"):a.each(Re)}(c),p&&(-1===(r=p).search("{actions}")?(l="offset",o=A):(l="position",o=S,r=r.replace("{actions}","")),(r=jQuery(r).filter(":visible")).length&&(o.scrollTop(0),o.scrollTop(r[l]().top))),a&&i&&Ve(i)}}function Pe(){var e,t,i,o="";if(this.value&&this.value.length>2){e=function(e,t){e=RVS.F.trim(e);for(var s,i,r,l,o,n,d="",c="",p="",h="",u="",f=w.length,_=[],m=0;m<f;m++)if(s=(i=de(a,w[m])).keywords)for(l=s.length,n=0;n<l;n++){try{o=s[n].search(e)}catch(e){continue}if(-1!==o&&-1===_.indexOf(w[m]))if(_[_.length]=w[m],r=i.buttonTitle||i.title,"general_how_to"===w[m].split(".")[0])d+=pe(r,w[m],i.helpPath);else switch(w[m].split(".")[1]){case"slider_settings":c+=pe(r,w[m],"slider");break;case"slide_settings":p+=pe(r,w[m],"slide");break;case"layer_settings":h+=pe(r,w[m],"layer");break;case"navigation_settings":u+=pe(r,w[m],"nav")}}return[d,c,u,p,h]}(this.value.toLowerCase());for(var n=1;n<5;n++)e[n]&&(o+=e[n]);o?(i=!0,E.html(o).show(),l.removeClass("help-options-empty")):(E.hide(),l.addClass("help-options-empty")),e[0]?(t=!0,o=e[0],C.html(o).show(),l.removeClass("help-faqs-empty")):(C.hide(),l.addClass("help-faqs-empty"))}if(i||t){s.html(r.helpMode),v.removeClass(fe).addClass("help-icon-default"),se(),Q.hide(),N.hide(),q.show(),D.css("visibility","visible");var d=Math.max(E.height(),C.height()),c=Math.min(RVS.WIN.height()/3,d);J.height(c),J[0].scrollTop=0,J[1].scrollTop=0,J.RSScroll("update"),clearTimeout(P),P=setTimeout(function(){J.RSScroll("update")},250)}else q.hide(),D.css("visibility","hidden"),se(!0);z.hide()}});