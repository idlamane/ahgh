(function(){var m={Version:"7.0.4728.16930"};window.cfx.highlow=m;var l=window.cfx,f=window.sfx,i=function d(){d._ic();this.a=this.b=0};m.LineData=i;i.prototype={_0LineData:function(d,a){d=f.e._t(d);a=f.e._t(a);d.x==a.x?(this.a=d.x,this.b=f.E.d):(this.a=(a.y-d.y)/(a.x-d.x),this.b=a.y-this.a*a.x);return this},intersect:function(d){if(this.a==d.a)return new f.e;var a=0,b=0;f.E.g(this.b)?(a=this.a,b=d.a*a+d.b):(a=(d.b-this.b)/(this.a-d.a),b=this.a*a+this.b);return(new f.e)._01e(a,b)},intersectY:function(d){return 0==
this.a?0:f.E.g(this.b)?this.a:(d-this.b)/this.a}};i.distance=function(d,a){var d=f.e._t(d),a=f.e._t(a),b=d.x-a.x,c=d.y-a.y;return f.a.r(b*b+c*c)};i.proyectPoint=function(d,a,b){var d=f.e._t(d),c=d.x+b*f.a.h(a),d=d.y+b*f.a.q(a);return(new f.e)._01e(c,d)};i._dt("CWHL",f.Sy,0);var n=function a(){a._ic();this.i=this.j=null;this.d=!1;this.c=0;this.g=this.b=this.h=this.a=this.e=this.f=null;this._0HighLow()};m.HighLow=n;n.prototype={_0HighLow:function(){return this},k:function(a,b,c,o){var g=new f.e,e=this.a.Se();
if(!a){var j=(new i)._0LineData(this.a.So(e-2),this.a.So(e-1)),h=(new i)._0LineData((new f.e)._01e(this.a.So(e-2).x,this.b.So(e-2)),(new f.e)._01e(this.a.So(e-1).x,this.b.So(e-1)));g._cf(j.intersect(h));e--}j=2*e;a||j++;for(var j=f.e._ca(j),k=h=0;k<e;k++,h++)j[h]._cf(this.a.So(k));a||j[h++]._cf(g);for(k=e-1;0<=k;k--,h++)j[h]._i1(this.a.So(k).x,this.b.So(k));e=null;h=0;0<this.c?(e=this.j,h=b.d-1):(e=this.i,h=b.d);0!=(b.y&8)&&(h=h.toString(),h=(new l.cY)._01cY("Attribute"+h),h.c="C,"+(b.d-1).toString(),
b.c.sids(h));b.c.id5(e,j);a||(this.a.clear(),this.b.clear(),this.a.Si(g),this.b.Si(g.y),this.a.Si(o),this.b.Si(c))},m:function(a){this.a=(new f.List_1)._0List_1();this.b=(new f.List_1)._0List_1();this.h=(new f.List_1)._0List_1();this.g=(new f.List_1)._0List_1();this.i=a.x.b();this.e=(new f.aq)._03aq(a.k.d(),a.b.k.a);a.aA(a.d-1);a.M(!0);this.j=a.x;this.f=(new f.aq)._03aq(a.k.d(),a.b.k.a)},l:function(){this.f._d();this.e._d();this.j._d();this.i._d()},reset:function(){},idf:function(){return 2},idg:function(){return 537604},
ide:function(a,b){switch(b){case 5:return"%s\n%l - %l\n%v - %v\n%s2\n%v~ - %v~"}return null},idh:function(a,b,c){a.b=1;a.a=0;var i=b=!1;if(c.e==c.n){i=!0;if(this.d)return;this.m(c)}else if(c.e==c.o){this.d=!this.d;if(!this.d){this.l();return}b=!0}else if(this.d)return;var g=c.t,e=c.a.b.iaW().getItem(c.d-1,c.e);if(!(c.N||1.0E108==e))if(a=0,a=g==e?0:g<e?-1:1,g=c.h.valueToPixel(e),e=(new f.e)._01e(c.i.b,c.i.a),this.h.Si(e),this.g.Si(g),i)this.c=a,this.a.Si(e),this.b.Si(g);else{if(a==this.c&&(0==a?(this.a.sSo(0,
e),this.b.sSo(0,g)):(this.a.Si(e),this.b.Si(g)),!b))return;this.a.Si(e);this.b.Si(g);if(0!=this.c||b)if(this.k(a==this.c,c,g,e),0==a&&(this.a.clear(),this.b.clear(),this.a.Si(e),this.b.Si(g)),b&&a!=this.c&&(this.c=a,this.k(!0,c,g,e)),b){b=this.h.toArray();if(i=0!=(c.y&8))g=c.d-1,g=(new l.cY)._01cY("Attribute"+g.toString()+"Line"),c.c.sids(g);c.c.idP(this.f,b);for(g=0;g<b.length;g++)b[g].y=this.g.So(g);i&&(g=(new l.cY)._01cY("Attribute"+c.d.toString()+"Line"),c.c.sids(g));c.c.idP(this.e,b)}this.c=
a}}};n._dt("CWHH",f.Sy,0,l.idd)})();
