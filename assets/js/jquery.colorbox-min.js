(function(a,b,c){function d(c,d,e){var f=b.createElement(c);return d&&(f.id=n+d),e&&(f.style.cssText=e),a(f)}function e(a){var b=G.length,c=(Y+a)%b;return c<0?b+c:c}function f(a,b){return Math.round((/%/.test(a)?(b==="x"?H.width():H.height())/100:1)*parseInt(a,10))}function g(a){return S.photo||/\.(gif|png|jpe?g|bmp|ico)((#|\?).*)?$/i.test(a)}function h(){var b;S=a.extend({},a.data(X,m));for(b in S)a.isFunction(S[b])&&b.slice(0,2)!=="on"&&(S[b]=S[b].call(X));S.rel=S.rel||X.rel||"nofollow",S.href=S.href||a(X).attr("href"),S.title=S.title||X.title,typeof S.href=="string"&&(S.href=a.trim(S.href))}function i(b,c){a.event.trigger(b),c&&c.call(X)}function j(){var a,b=n+"Slideshow_",c="click."+n,d,e,f;S.slideshow&&G[1]?(d=function(){N.text(S.slideshowStop).unbind(c).bind(r,function(){if(Y<G.length-1||S.loop)a=setTimeout(cb.next,S.slideshowSpeed)}).bind(q,function(){clearTimeout(a)}).one(c+" "+s,e),z.removeClass(b+"off").addClass(b+"on"),a=setTimeout(cb.next,S.slideshowSpeed)},e=function(){clearTimeout(a),N.text(S.slideshowStart).unbind([r,q,s,c].join(" ")).one(c,function(){cb.next(),d()}),z.removeClass(b+"on").addClass(b+"off")},S.slideshowAuto?d():e()):z.removeClass(b+"off "+b+"on")}function k(b){if(!ab){X=b,h(),G=a(X),Y=0,S.rel!=="nofollow"&&(G=a("."+o).filter(function(){var b=a.data(this,m).rel||this.rel;return b===S.rel}),Y=G.index(X),Y===-1&&(G=G.add(X),Y=G.length-1));if(!$){$=_=!0,z.show();if(S.returnFocus)try{X.blur(),a(X).one(t,function(){try{this.focus()}catch(a){}})}catch(c){}y.css({opacity:+S.opacity,cursor:S.overlayClose?"pointer":"auto"}).show(),S.w=f(S.initialWidth,"x"),S.h=f(S.initialHeight,"y"),cb.position(),w&&H.bind("resize."+x+" scroll."+x,function(){y.css({width:H.width(),height:H.height(),top:H.scrollTop(),left:H.scrollLeft()})}).trigger("resize."+x),i(p,S.onOpen),R.add(L).hide(),Q.html(S.close).show()}cb.load(!0)}}var l={transition:"elastic",speed:300,width:!1,initialWidth:"600",innerWidth:!1,maxWidth:!1,height:!1,initialHeight:"450",innerHeight:!1,maxHeight:!1,scalePhotos:!0,scrolling:!0,inline:!1,html:!1,iframe:!1,fastIframe:!0,photo:!1,href:!1,title:!1,rel:!1,opacity:.9,preloading:!0,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",open:!1,returnFocus:!0,loop:!0,slideshow:!1,slideshowAuto:!0,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:!1,onLoad:!1,onComplete:!1,onCleanup:!1,onClosed:!1,overlayClose:!0,escKey:!0,arrowKey:!0,top:!1,bottom:!1,left:!1,right:!1,fixed:!1,data:undefined},m="colorbox",n="cbox",o=n+"Element",p=n+"_open",q=n+"_load",r=n+"_complete",s=n+"_cleanup",t=n+"_closed",u=n+"_purge",v=a.browser.msie&&!a.support.opacity,w=v&&a.browser.version<7,x=n+"_IE6",y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,$,_,ab,bb,cb,db="div";cb=a.fn[m]=a[m]=function(b,c){var d=this;b=b||{},cb.init();if(!d[0]){if(d.selector)return d;d=a("<a/>"),b.open=!0}return c&&(b.onComplete=c),d.each(function(){a.data(this,m,a.extend({},a.data(this,m)||l,b)),a(this).addClass(o)}),(a.isFunction(b.open)&&b.open.call(d)||b.open)&&k(d[0]),d},cb.init=function(){if(!z){if(!a("body")[0]){a(cb.init);return}H=a(c),z=d(db).attr({id:m,"class":v?n+(w?"IE6":"IE"):""}),y=d(db,"Overlay",w?"position:absolute":"").hide(),A=d(db,"Wrapper"),B=d(db,"Content").append(I=d(db,"LoadedContent","width:0; height:0; overflow:hidden"),K=d(db,"LoadingOverlay").add(d(db,"LoadingGraphic")),L=d(db,"Title"),M=d(db,"Current"),O=d(db,"Next"),P=d(db,"Previous"),N=d(db,"Slideshow").bind(p,j),Q=d(db,"Close")),A.append(d(db).append(d(db,"TopLeft"),C=d(db,"TopCenter"),d(db,"TopRight")),d(db,!1,"clear:left").append(D=d(db,"MiddleLeft"),B,E=d(db,"MiddleRight")),d(db,!1,"clear:left").append(d(db,"BottomLeft"),F=d(db,"BottomCenter"),d(db,"BottomRight"))).find("div div").css({"float":"left"}),J=d(db,!1,"position:absolute; width:9999px; visibility:hidden; display:none"),a("body").prepend(y,z.append(A,J)),T=C.height()+F.height()+B.outerHeight(!0)-B.height(),U=D.width()+E.width()+B.outerWidth(!0)-B.width(),V=I.outerHeight(!0),W=I.outerWidth(!0),z.css({"padding-bottom":T,"padding-right":U}).hide(),O.click(function(){cb.next()}),P.click(function(){cb.prev()}),Q.click(function(){cb.close()}),R=O.add(P).add(M).add(N),y.click(function(){S.overlayClose&&cb.close()}),a(b).bind("keydown."+n,function(a){var b=a.keyCode;$&&S.escKey&&b===27&&(a.preventDefault(),cb.close()),$&&S.arrowKey&&G[1]&&(b===37?(a.preventDefault(),P.click()):b===39&&(a.preventDefault(),O.click()))})}},cb.remove=function(){z.add(y).remove(),z=null,a("."+o).removeData(m).removeClass(o)},cb.position=function(a,b){function c(a){C[0].style.width=F[0].style.width=B[0].style.width=a.style.width,K[0].style.height=K[1].style.height=B[0].style.height=D[0].style.height=E[0].style.height=a.style.height}var d=0,e=0,g=z.offset(),h=H.scrollTop(),i=H.scrollLeft();H.unbind("resize."+n),z.css({top:-9e4,left:-9e4}),S.fixed&&!w?(g.top-=h,g.left-=i,z.css({position:"fixed"})):(d=h,e=i,z.css({position:"absolute"})),S.right!==!1?e+=Math.max(H.width()-S.w-W-U-f(S.right,"x"),0):S.left!==!1?e+=f(S.left,"x"):e+=Math.round(Math.max(H.width()-S.w-W-U,0)/2),S.bottom!==!1?d+=Math.max(H.height()-S.h-V-T-f(S.bottom,"y"),0):S.top!==!1?d+=f(S.top,"y"):d+=Math.round(Math.max(H.height()-S.h-V-T,0)/2),z.css({top:g.top,left:g.left}),a=z.width()===S.w+W&&z.height()===S.h+V?0:a||0,A[0].style.width=A[0].style.height="9999px",z.dequeue().animate({width:S.w+W,height:S.h+V,top:d,left:e},{duration:a,complete:function(){c(this),_=!1,A[0].style.width=S.w+W+U+"px",A[0].style.height=S.h+V+T+"px",b&&b(),setTimeout(function(){H.bind("resize."+n,cb.position)},1)},step:function(){c(this)}})},cb.resize=function(a){$&&(a=a||{},a.width&&(S.w=f(a.width,"x")-W-U),a.innerWidth&&(S.w=f(a.innerWidth,"x")),I.css({width:S.w}),a.height&&(S.h=f(a.height,"y")-V-T),a.innerHeight&&(S.h=f(a.innerHeight,"y")),!a.innerHeight&&!a.height&&(I.css({height:"auto"}),S.h=I.height()),I.css({height:S.h}),cb.position(S.transition==="none"?0:S.speed))},cb.prep=function(b){function c(){return S.w=S.w||I.width(),S.w=S.mw&&S.mw<S.w?S.mw:S.w,S.w}function f(){return S.h=S.h||I.height(),S.h=S.mh&&S.mh<S.h?S.mh:S.h,S.h}if(!$)return;var h,j=S.transition==="none"?0:S.speed;I.remove(),I=d(db,"LoadedContent").append(b),I.hide().appendTo(J.show()).css({width:c(),overflow:S.scrolling?"auto":"hidden"}).css({height:f()}).prependTo(B),J.hide(),a(Z).css({"float":"none"}),w&&a("select").not(z.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(s,function(){this.style.visibility="inherit"}),h=function(){function b(){v&&z[0].style.removeAttribute("filter")}var c,f,h=G.length,k,l="frameBorder",o="allowTransparency",p,q,s;if(!$)return;p=function(){clearTimeout(bb),K.hide(),i(r,S.onComplete)},v&&Z&&I.fadeIn(100),L.html(S.title).add(I).show();if(h>1){typeof S.current=="string"&&M.html(S.current.replace("{current}",Y+1).replace("{total}",h)).show(),O[S.loop||Y<h-1?"show":"hide"]().html(S.next),P[S.loop||Y?"show":"hide"]().html(S.previous),S.slideshow&&N.show();if(S.preloading){c=[e(-1),e(1)];while(f=G[c.pop()])q=a.data(f,m).href||f.href,a.isFunction(q)&&(q=q.call(f)),g(q)&&(s=new Image,s.src=q)}}else R.hide();S.iframe?(k=d("iframe")[0],l in k&&(k[l]=0),o in k&&(k[o]="true"),k.name=n+ +(new Date),S.fastIframe?p():a(k).one("load",p),k.src=S.href,S.scrolling||(k.scrolling="no"),a(k).addClass(n+"Iframe").appendTo(I).one(u,function(){k.src="//about:blank"})):p(),S.transition==="fade"?z.fadeTo(j,1,b):b()},S.transition==="fade"?z.fadeTo(j,0,function(){cb.position(0,h)}):cb.position(j,h)},cb.load=function(b){var c,e,j=cb.prep;_=!0,Z=!1,X=G[Y],b||h(),i(u),i(q,S.onLoad),S.h=S.height?f(S.height,"y")-V-T:S.innerHeight&&f(S.innerHeight,"y"),S.w=S.width?f(S.width,"x")-W-U:S.innerWidth&&f(S.innerWidth,"x"),S.mw=S.w,S.mh=S.h,S.maxWidth&&(S.mw=f(S.maxWidth,"x")-W-U,S.mw=S.w&&S.w<S.mw?S.w:S.mw),S.maxHeight&&(S.mh=f(S.maxHeight,"y")-V-T,S.mh=S.h&&S.h<S.mh?S.h:S.mh),c=S.href,bb=setTimeout(function(){K.show()},100),S.inline?(d(db).hide().insertBefore(a(c)[0]).one(u,function(){a(this).replaceWith(I.children())}),j(a(c))):S.iframe?j(" "):S.html?j(S.html):g(c)?(a(Z=new Image).addClass(n+"Photo").error(function(){S.title=!1,j(d(db,"Error").text("This image could not be loaded"))}).load(function(){var a;Z.onload=null,S.scalePhotos&&(e=function(){Z.height-=Z.height*a,Z.width-=Z.width*a},S.mw&&Z.width>S.mw&&(a=(Z.width-S.mw)/Z.width,e()),S.mh&&Z.height>S.mh&&(a=(Z.height-S.mh)/Z.height,e())),S.h&&(Z.style.marginTop=Math.max(S.h-Z.height,0)/2+"px"),G[1]&&(Y<G.length-1||S.loop)&&(Z.style.cursor="pointer",Z.onclick=function(){cb.next()}),v&&(Z.style.msInterpolationMode="bicubic"),setTimeout(function(){j(Z)},1)}),setTimeout(function(){Z.src=c},1)):c&&J.load(c,S.data,function(b,c,e){j(c==="error"?d(db,"Error").text("Request unsuccessful: "+e.statusText):a(this).contents())})},cb.next=function(){!_&&G[1]&&(Y<G.length-1||S.loop)&&(Y=e(1),cb.load())},cb.prev=function(){!_&&G[1]&&(Y||S.loop)&&(Y=e(-1),cb.load())},cb.close=function(){$&&!ab&&(ab=!0,$=!1,i(s,S.onCleanup),H.unbind("."+n+" ."+x),y.fadeTo(200,0),z.stop().fadeTo(300,0,function(){z.add(y).css({opacity:1,cursor:"auto"}).hide(),i(u),I.remove(),setTimeout(function(){ab=!1,i(t,S.onClosed)},1)}))},cb.element=function(){return a(X)},cb.settings=l,a("."+o,b).live("click",function(a){a.which>1||a.shiftKey||a.altKey||a.metaKey||(a.preventDefault(),k(this))}),cb.init()})(jQuery,document,this)