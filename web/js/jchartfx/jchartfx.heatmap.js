(function(){var l={Version:"7.0.4728.16930"};window.cfx.heatmap=l;var d=window.cfx,c=window.sfx,k=function p(){p._ic();this.b=this.c=0;this._0ColorGradientStop()};l.ColorGradientStop=k;k.prototype={_0ColorGradientStop:function(){this.d=new c.m;this.a=new c.m;return this},getColor:function(){return this.d},setColor:function(d){d=c.m._t(d);this.d._cf(d);this.a._cf(d)},getOffset:function(){return this.c},setOffset:function(c){this.c=c}};k._dt("CWGC",c.Sy,0);var n=function q(){q._ic()};l.ColorGradientCollection=
n;n.prototype={_0ColorGradientCollection:function(){this.a=(new c.List_1)._0List_1();return this},getCount:function(){return this.a.Se()},getItem:function(c){return this.a.So(c)},setItem:function(c,a){this.a.sSo(c,a)},add:function(c){this.a.Si(c)},clear:function(){this.a.clear()},colorForValue:function(d){var a=this.a.Se(),e=this.a.So(0);if(d==e.b)return e.a;for(var b=1;b<a;b++){var f=this.a.So(b),h=f.b;if(h==d)return f.a;if(h>d)return b=h-e.b,a=(d-e.b)/b,d=(h-d)/b,e=e.a._nc(),f=f.a._nc(),c.m.j(e.r*
a+f.r*d,e.g*a+f.g*d,e.b*a+f.b*d);e=f}return e.a},insert:function(c,a){this.a.Sl(c,a)}};n._dt("CWGC",c.Sy,0);var o=function a(){a._ic();this.c=null;this.i=this.j=this.g=this.k=this.e=this.f=this.b=this.h=0;this._0HeatMap()};l.HeatMap=o;o.prototype={_0HeatMap:function(){this.a=(new n)._0ColorGradientCollection();this.d=3;var a=new k;a.setColor(c.m.j(192,0,0));this.a.add(a);a=new k;a.setColor(c.m.j(0,192,0));this.a.add(a);return this},getGradientStops:function(){return this.a},iex:function(){return null},
iew:function(){return!1},iey:function(){return!0},getLegendHeight:function(){return this.d},setLegendHeight:function(a){this.d=a},l:function(a){return this.c.getAxisY().getDataFormat().a(a)},ieB:function(){return this.d},reset:function(){},idf:function(){return 1},idl:function(){var a=this.c.getAxisY(),e=a.getLabels();e.clear();e.add("");for(var b=this.c.getSeries().Sb();!0==b.SK();){var f=b.SM();e.add(f.getText())}a.setMin(0);a.setMax(e.Se()-1);a.setLabelValue(1);a.setStyle(a.k|512);this.e=c.E.b;
this.f=c.E.c;a=this.c.r;e=a.iaU();b=a.iaQ();for(f=0;f<e;f++)for(var h=0;h<b;h++){var d=a.getItem(f,h);1.0E108!=d&&(this.e=c.a.o(this.e,d),this.f=c.a.n(this.f,d))}this.k=this.f-this.e;return!1},idg:function(){return 4096},_iCommands:function(){return!1},icB:function(a){this.c=c.W.D(a,d.Chart);this.c.getLegendBox().getItemAttributes().getItemList(this.c.getSeries()).setVisible(!1);return!0},ieC:function(){return!1},iez:function(){},overrideWizardValidation:function(){},icC:function(){return null},idk:function(){return!0},
getHighlightArgs:function(){return!1},idj:function(){},ide:function(){return null},idm:function(){return!1},idh:function(a,e,b){e=b.c;a.b=1;a.a=0;a=0!=(b.y&8);if(b.e==b.n&&b.d==b.p){this.g=c.v.d(b.w.w,c.a.d(b.o-b.n)+1);this.h=c.v.d(b.w.h,c.a.d(b.q-b.p)+1);this.j=b.w.x;this.i=b.w.y;for(var f=!0,h=this.a.getCount(),g=0;g<h;g++){var i=this.a.getItem(g),j=i.d._nc();if(a){var m=(new d.cY)._01cY("HeatMap"+g.toString());e.sids(m);j=e.a._Gv("fill",j,null,0)}i.a._cf(j);i.b=i.c;0!=i.b&&(f=!1)}if(f&&1<h){j=
f=1/(h-1);for(g=1;g<h;g++)i=this.a.getItem(g),i.b=j,j+=f}}b.N||(h=b.e*this.g,g=b.d*this.h,a&&(a=(new d.cY)._01cY(null),i=e.idr().ieX(b.c.ids()),a.c=i.ifh(1),a.e=i.ifh(0),e.sids(a)),b=this.a.colorForValue((b.t-this.e)/this.k)._nc(),b=(new c.au)._0au(b),e.id$(b,h+this.j,g+this.i,this.g,this.h),b._d())},ieD:function(a,e,b,f){a.a=!0;f._cf(c.g.b);return e.ieb(this.l(this.f),b).c()},ieA:function(){this.b=0},ieE:function(a,e){a.a=null;var b=0==this.b?this.f:this.e;a.b=0==this.b||this.b==this.d-1?this.l(b):
" ";a.c=null;a.d=this.b;if(this.b>=this.d)return!1;e.b.e=0;if(0==this.b){var f=e.H,d=e.H+this.d*e.aE-e.v,g=e.ab-6;e.c.sids(null);b=(new c.c)._02c(g,f+1,16,d-f-2);f=(new c.aH)._0aH((new c.e)._01e(g,f),(new c.e)._01e(g,d),this.a.getItem(1).a,this.a.getItem(0).a);d=this.a.getCount();if(2<d){for(var g=(new c.aB)._01aB(d),i=c.m._ca(d),j=Array(d),m=0;m<d;m++){var k=this.a.getItem(d-1-m),l=m;i[l]._cf(k.a);j[l]=1-k.b}g.sb(i);g.sc(j);f.sk(g)}e.c.id7(f,b);f._d();f=this.c.iaj(3)._nc();f=(new c.aq)._01aq(f);
e.c.idR(f,b);f._d()}this.b++;return!0}};o._dt("CWGH",c.Sy,0,d.icA,d.idd,d.idi,d.iev,d.ip)})();