(function(){var u={Version:"7.0.4728.16930"};window.cfx.handdrawn=u;var t=window.cfx,j=window.sfx,i=function p(){p._ic()};i.prototype={};i.l=function(j,b,a,e,c,d,g,f,h){d=i.k(e/2,d,g);b+=e/2;a+=c/2;for(c=0;c<d.length;c++)d[c].x=d[c].x+b+i.c(f,h),d[c].y=d[c].y+a+i.c(f,h);j.j(d);return d[d.length-1]};i.d=function(p,b,a,e,c,d,g){var f=e-b,h=c-a,k=j.a.d(f),h=j.a.d(h),l=0,m=0,q=0,n=0;20>k||20>h?0!=f?(l=b,m=a+i.b(d,g),q=b,n=a+i.b(d,g)):(l=b+i.b(d,g),m=a,q=b+i.b(d,g),n=a):(l=(2*b+e)/3,m=(2*a+c)/3,q=(b+2*
e)/3,n=(a+2*c)/3,f=i.c(d,1.5*g),d=i.c(d,1.5*g),k>h?(m+=f,n+=d):(l+=f,q+=d));p.i(b,a,l,m,q,n,e,c)};i.k=function(p,b,a){0>b&&(b+=360);var b=b*j.a.c/180,a=a*j.a.c/180,e=b+a,c=!1;0>a&&(a=b,b=e,e=a,c=!0);var d=2*j.a.c,a=j.a.c/2;0>b&&(b+=d,e+=d);for(var g=b,f=j.a.j(g/a),e=j.a.o(d,e-b),h=1,k=e;1.0E-5<k;){var d=g+j.a.o(k,a),l=j.a.j(d/a);f!=l&&(d=a*(f+1));h+=3;k-=d-g;g=d;f=l}var k=j.f._ca(h),g=b,f=j.a.j(g/a),b=p*j.a.h(g),m=p*j.a.q(g),q=0,n=0;c?(n=h-1,q=-1):(n=0,q=1);k[n].x=b;k[n].y=m;for(n+=q;1.0E-5<e;)d=
g+j.a.o(e,a),l=j.a.j(d/a),f!=l&&(d=a*(f+1)),c=p*j.a.h(d),h=p*j.a.q(d),g=d-g,n=i.m(p,g,f,b,m,c,h,k,n,q),e-=g,g=d,f=l,b=c,m=h;return k};i.m=function(i,b,a,e,c,d,g,f,h,k){var l=1,m=1;3==a?m=-1:2==a?m=l=-1:1==a&&(l=-1);0.01>j.a.d(b-j.a.c/2)?(e=0.552285*i,3==a||1==a?(f[h].x=e*l,f[h].y=i*m,h+=k,f[h].x=i*l,f[h].y=e*m):(f[h].x=i*l,f[h].y=e*m,h+=k,f[h].x=e*l,f[h].y=i*m)):(i=e*e+c*c,a=i+e*d+c*g,i=4/3*(j.a.r(2*i*a)-a)/(e*g-c*d),f[h].x=e-i*c,f[h].y=c+i*e,h+=k,f[h].x=d+i*g,f[h].y=g-i*d);h+=k;f[h].x=d;f[h].y=g;
return h+k};i.f=function(p,b,a,e,c,d,g,f){var h=(new j.aE)._0aE();i.l(h,p,b,a,e,c,d,g,f);return h};i.i=function(p,b,a,e,c,d){var g=(new j.aE)._0aE(),f=j.f._ca(13);f[0]._i1(a,e/2);f[1]._i1(i.a(1,c,d,a),i.a(0.775,c,d,e));f[2]._i1(i.a(0.775,c,d,a),i.a(1,c,d,e));f[3]._i1(i.a(0.5,c,d,a),i.a(1,c,d,e));f[4]._i1(i.a(0.225,c,d,a),i.a(1,c,d,e));f[5]._i1(i.a(0,c,d,a),i.a(0.775,c,d,e));f[6]._i1(i.a(0,c,d,a),i.a(0.5,c,d,e));f[7]._i1(i.a(0,c,d,a),i.a(0.225,c,d,e));f[8]._i1(i.a(0.225,c,d,a),i.a(0,c,d,e));f[9]._i1(i.a(0.5,
c,d,a),i.a(0,c,d,e));f[10]._i1(i.a(0.775,c,d,a),i.a(0,c,d,e));f[11]._i1(i.a(1,c,d,a),i.a(0.225,c,d,e));f[12]._i1(a,e/2);for(a=0;a<f.length;a++)f[a].x+=p,f[a].y+=b;g.j(f);return g};i.e=function(p,b,a,e,c,d,g){var f=(new j.aE)._0aE(),h=0,k=!0;5>j.a.d(p-a)?k=70<j.a.d(b-e):5>j.a.d(b-e)&&(k=70<j.a.d(p-a));k&&(h=i.c(c,g),i.c(c,g));i.d(f,p,b,a+h,e+h,c,d);return f};i.h=function(p,b,a){var e=(new j.aE)._0aE();p.hasArcs=!1;for(var c=p.c(),p=p.d(),d=c[0]._nc(),g=0,g=0==p[0]?1:0;g<p.length;){var f=c[g]._nc(),
h=p[g]&15;if(1==h)i.d(e,d.x,d.y,f.x,f.y,b,a),g++,d._cf(f);else if(3==h){var h=c[g+1]._nc(),k=c[g+2]._nc();f.x+=i.b(b,a);f.y+=i.b(b,a);h.x+=i.b(b,a);h.y+=i.b(b,a);k.x+=i.b(b,a-0.5);k.y+=i.b(b,a-0.5);e.i(d.x,d.y,f.x,f.y,h.x,h.y,k.x,k.y);d._cf(k);g+=3}else 4==h&&(h=c[g+1],k=c[g+2],d._cf(i.l(e,f.x,f.y,h.x,h.y,k.x,k.y,b,a)),g+=3)}0!=(p[p.length-1]&128)&&e.z();return e};i.g=function(p,b,a,e,c,d,g,f){if(a<=f)return i.e(p,b,p,b+e,c,d,0);if(e<=f)return i.e(p,b,p+a,b,c,d,0);var f=j.a.o(a/2,g+c.d()*d),h=j.a.o(a/
2,g+c.d()*d),k=j.a.o(a/2,g+c.d()*d),l=j.a.o(a/2,g+c.d()*d),m=j.a.o(e/2,g+c.d()*d),q=j.a.o(e/2,g+c.d()*d),n=j.a.o(e/2,g+c.d()*d),r=j.a.o(e/2,g+c.d()*d),g=(new j.aE)._0aE(),o=j.f._ca(25);o[0]._i1(0,m);o[1]._i1(0,m/2);o[2]._i1(f/2,0);o[3]._i1(f,0);o[4]._i1(a/2,i.b(c,d));o[5]._i1(a/2,i.b(c,d));o[6]._i1(a-h,0);o[7]._i1(a-h/2,0);o[8]._i1(a,q/2);o[9]._i1(a,q);o[10]._i1(i.a(1,c,d,a),e/2);o[11]._i1(i.a(1,c,d,a),e/2);o[12]._i1(a,e-r);o[13]._i1(a,e-r/2);o[14]._i1(a-l/2,e);o[15]._i1(a-l,e);o[16]._i1(a/2,i.a(1,
c,d,e));o[17]._i1(a/2,i.a(1,c,d,e));o[18]._i1(k,e);o[19]._i1(k/2,e);o[20]._i1(0,e-n/2);o[21]._i1(0,e-n);o[22]._i1(i.b(c,d),e/2);o[23]._i1(i.b(c,d),e/2);o[24]._i1(0,m);for(a=0;a<o.length;a++)o[a].x+=p,o[a].y+=b;g.j(o);return g};i.c=function(i,b){return i.d()*2*b-b};i.a=function(i,b,a,e){var c=b.d();1!=b.b()%3&&(c*=-1);return e*i+c*a};i.b=function(i,b){var a=i.d();1!=i.b()%3&&(a*=-1);return a*b};i._dt("CWHU",j.Sy,0);var v=function b(){b._ic();this.v=null;this.A=0;this.y=this.a=this.r=this.t=this.u=
this.z=null;this.q=!1;this.i=0;this._0HandDrawn()};u.HandDrawn=v;v.prototype={_0HandDrawn:function(){this.b=(new j.U)._0U();this.e=this.d=this.c=3;this.h=!0;this.j=3;this.g=0.75;this.k=20;return this},idr:function(){return this.y},sidr:function(b){this.y=b;this.a.CH(b)},ids:function(){return this.z},sids:function(b){this.q=!1;this.z=b;var a=j.W.C(b,t.ifg);null!=a&&(a=a.ifh(2),j.b.q(a,"Border")&&(this.q=!0));this.a.CO(b)},getFillStrokeAngle:function(){return this.k},setFillStrokeAngle:function(b){this.k=
b;this.f()},getFillStrokeCurvePercentage:function(){return this.g},setFillStrokeCurvePercentage:function(b){this.g=b;this.f()},getFillStrokeThickness:function(){return this.j},setFillStrokeThickness:function(b){this.j=b;this.f()},getFillWithStrokes:function(){return this.h},setFillWithStrokes:function(b){this.h=b;this.f()},idp:function(){var b=1;this.a.st&&(b|=8);return b|52},idu:function(){return this.i},sidu:function(b){this.i=b},idt:function(){return this.a},sidt:function(b){this.a=b;this.i=11},
idq:function(){return this.a.b()},sidq:function(b){this.a.sb(b)},idv:function(){return this.a.e()},sidv:function(b){this.a.se(b)},getMessiness:function(){return this.e},setMessiness:function(b){this.e=b;this.f()},getRandomness:function(){return this.c},setRandomness:function(b){this.c=b;this.f()},getStrokeOffsetRandomness:function(){return this.d},setStrokeOffsetRandomness:function(b){this.d=b;this.f()},o:function(){var b=(new j.aE)._0aE();b.Z=!1;return b},H:function(b,a,e,c,d,g,f){var h=this.e,k=
this.c;if(10>=c||10>=d)k=h=2;if(1>=h&&0==this.d)h=i.f(a,e,c,d,g,f,this.b,k),this.a.v(b,h),h._d();else for(var l=j.a.n(h,1),m=0;m<l;m++)h=i.f(a,e,c,d,g,f,this.b,k),this.a.v(b,h),h._d()},G:function(b,a,e,c,d){var g=this.e,f=this.c;if(10>=c||10>=d)f=g=2;if(1>=g&&0==this.d)g=i.i(a,e,c,d,this.b,f),this.a.v(b,g),g._d();else for(var h=j.a.n(g,1),k=0;k<h;k++)g=i.i(a,e,c,d,this.b,f),this.a.v(b,g),g._d()},F:function(b,a,e,c,d){if(1>=this.e&&0==this.d){var g=i.e(a,e,c,d,this.b,this.c,this.d);this.a.v(b,g);g._d()}else for(var f=
j.a.n(this.e,1),h=0;h<f;h++)g=i.e(a,e,c,d,this.b,this.c,this.d),this.a.v(b,g),g._d()},n:function(b,a,e){if(1>=this.e&&0==this.d){for(var c=this.o(),d=a[0]._nc(),g=1;g<a.length;g++){var f=a[g]._nc();i.d(c,d.x,d.y,f.x,f.y,this.b,this.c);d._cf(f)}e&&(f=a[0]._nc(),i.d(c,d.x,d.y,f.x,f.y,this.b,this.c));this.a.v(b,c);c._d()}else for(var h=j.a.n(this.e,1),g=0;g<h;g++){for(var c=this.o(),d=a[0]._nc(),k=-1,l=1;l<a.length;)f=a[l]._nc(),i.d(c,d.x,d.y,f.x,f.y,this.b,this.c),d._cf(f),l++,l<a.length&&(0<this.d&&
3<=l-k&&0.7<this.b.d())&&(this.a.v(b,c),c._d(),c=this.o(),d.x+=i.c(this.b,this.d),d.y+=i.c(this.b,this.d),k=l);e&&(f=a[0]._nc(),i.d(c,d.x,d.y,f.x,f.y,this.b,this.c));this.a.v(b,c);c._d()}},m:function(b,a,e,c,d){var g=this.e,f=this.c;if(1>=g&&0==this.d)g=i.g(a,e,c,d,this.b,f,0,1),this.a.v(b,g),g._d();else for(var f=j.a.n(g,1),h=0;h<f;h++)g=i.g(a,e,c,d,this.b,this.c,0,1),this.a.v(b,g),g._d()},E:function(b,a,e,c,d){a=i.f(a,e,c,d,0,360,this.b,this.c);this.D(b,a,a);a._d()},J:function(b,a){var e=i.h(a,
this.b,this.c);this.D(b,a,e);e._d()},D:function(b,a,e){var c=!0;if(this.h){a.hasArcs=!1;var d=a.c(),a=a.d(),d=this.B(d,a);this.p(b,d.x,d.y,d.w,d.h)&&(c=this.a.b(),this.a.sb((new j.at)._01at(e)),this.x(b,d.x,d.y,d.w,d.h,this.b),this.a.sb(c),c=!1)}c&&this.a.H(b,e)},C:function(b,a){var e=this.I(a);if(this.h){var c=this.B(a,null);if(this.p(b,c.x,c.y,c.w,c.h)){var d=this.a.b();this.a.sb((new j.at)._01at(e));this.x(b,c.x,c.y,c.w,c.h,this.b);this.a.sb(d);return}}e=i.h(e,this.b,this.c);this.a.H(b,e);e._d()},
l:function(b,a,e,c,d,g){this.p(b,a,e,c,d)?this.x(b,a,e,c,d,g):this.a.N(b,a,e,c,d)},x:function(b,a,e,c,d,g){if(!(0==c||0==d)){var f=this.j,h=this.k,k=null;if(4>d)h=0,f=1,null==this.u&&(this.u=this.w(0)),k=this.u;else if(4>c)h=90,f=1,null==this.r&&(this.r=this.w(90)),k=this.r;else{if(h!=this.A||null==this.t)this.t=this.w(h);k=this.t}b=(new j.aq)._02aq(b,f);b.si(2);for(var a=a+0.6*f,c=c-1.6*f,l=a,m=e+2*f,q=a+c,d=e+(d-f),n=0,r=0,o=0,s=0,t=!0,v=k.length,x=this.o(),s=o=0,y=0.8*f,u=0.6*f,A=f,C=0!=this.g&&
1!=this.g,B=1==this.g,z=0;800>z;z++){r=g.b()%v;if(t){n=l+c;r=m-c*k[r];r<e&&(o=(r-m)/(n-l),s=m-o*l,r=e,n=(e-s)/o);n>q&&(o=(r-m)/(n-l),s=m-o*l,n=q,r=o*n+s);var o=n,s=r,w=this.b.d();0.15>w?n=n+u+this.b.d()*y:0.85>w&&(n-=this.b.d()*y)}else n=l-c,r=m+c*k[r],n<a&&(o=(r-m)/(n-l),s=m-o*l,n=a,r=o*n+s),r>d&&(o=(r-m)/(n-l),s=m-o*l,r=d,n=(r-s)/o),o=n,s=r,w=this.b.d(),0.15>w?n-=u+this.b.d()*y:0.85>w&&(n+=this.b.d()*y);if(r>=d&&n>=q)break;C&&(B=g.d()<this.g);B?i.d(x,l,m,n,r,this.b,this.c):x.t(l,m,n,r);l=o;m=s;
t?(n=1.2*f*this.b.d(),1>n&&(n=1),m+=n):(o>=n&&(m+=1.2*f*this.b.d()),l+=this.b.d()*(f-1));t=!t;if(j.a.d(m-d)<A&&j.a.d(l-q)<A)break;if(0==h&&m>d)break;799==z&&j.ai.R("Exhausted Loop")}this.a.v(b,x);x._d();b._d()}},B:function(b,a){var e=0,c=0,d=0,g=0,f=0;null==a||4!=a[0]?(e=b[0].x,d=b[0].y,c=e,g=d,f=1):(e=d=j.D.b,c=g=j.D.c,f=0);for(;f<b.length;f++){var h=b[f]._nc();if(null!=a&&4==a[f]){var k=b[f+1],l=b[f+2],m=k.x/2,q=h.x+m,k=h.y+k.y/2,l=i.k(m,l.x,l.y);q<e&&(e=q);q>c&&(c=q);k<d&&(d=k);k>g&&(g=k);for(m=
0;m<l.length;m++)(h._cf(l[m]),h.x+=q,h.y+=k,h.x<e?e=h.x:h.x>c&&(c=h.x),h.y<d)?d=h.y:h.y>g&&(g=h.y);h.x=q;h.y=k;f+=2}h.x<e?e=h.x:h.x>c&&(c=h.x);h.y<d?d=h.y:h.y>g&&(g=h.y)}return(new j.d)._02d(e,d,c-e,g-d)},_d:function(){},_iCommands:function(){return!0},icB:function(b){this.v=j.W.C(b,t.iN);return!0},icC:function(){return null},iea:function(b){return b.k(this.a)},ief:function(b,a){this.a.Z(b,a)},ied:function(b,a){this.a.X(b,a)},ieb:function(b,a){return this.a.T(b,a)},id5:function(b,a){this.C(b,a)},
id6:function(b,a){this.C(b,a)},id7:function(b,a){this.l(b,a.x,a.y,a.w,a.h,this.b)},id_:function(b,a){this.a.O(b,a)},id8:function(b,a){this.l(b,a.x,a.y,a.w,a.h,this.b)},id3:function(b,a){this.J(b,a)},idB:function(b,a){this.a.l(b,a,(new j.d)._02d(0,0,b.c(),b.b()),2)},idO:function(b,a){for(var e=a.length,c=1;c<e;c++)this.a.q(b,a[c-1].x,a[c-1].y,a[c].x,a[c].y);this.a.q(b,a[e-1].x,a[e-1].y,a[0].x,a[0].y)},idP:function(b,a){this.n(b,a,!1)},idM:function(b,a){this.n(b,a,!0)},idQ:function(b,a){this.n(b,a,
!1)},idN:function(b,a){this.n(b,a,!0)},idR:function(b,a){this.m(b,a.x,a.y,a.w,a.h)},idS:function(b,a){this.m(b,a.x,a.y,a.w,a.h)},idK:function(b,a){this.a.v(b,a)},iec:function(b,a){this.a.U(b,a)},renderToolBarCommand:function(){},ieg:function(b,a,e){this.a.aa(b,a,e)},iee:function(b,a,e){this.a.Y(b,a,e)},idC:function(b,a,e){this.a.j(b,a,e)},idD:function(b,a,e){this.a.k(b,a,e)},id4:function(b,a,e,c){this.a.I(b,a,e,c)},idE:function(b,a,e,c){this.a.m(b,a,e,c,2)},idF:function(b,a,e,c){this.a.n(b,a,e,c,
2)},idL:function(b,a,e,c){this.a.w(b,a,e,c)},idV:function(b,a,e,c,d){this.a.D(b,a,e,c,d)},id1:function(b,a,e,c,d){this.E(b,a,e,c,d)},id9:function(b,a,e,c,d){this.l(b,a,e,c,d,this.b)},id2:function(b,a,e,c,d){this.E(b,a,e,c,d)},id$:function(b,a,e,c,d){this.l(b,a,e,c,d,this.b)},idz:function(b,a,e,c,d){this.G(b,a,e,c,d)},idI:function(b,a,e,c,d){this.F(b,a,e,c,d)},idT:function(b,a,e,c,d){this.m(b,a,e,c,d)},idJ:function(b,a,e,c,d){this.F(b,a,e,c,d)},idU:function(b,a,e,c,d){this.m(b,a,e,c,d)},idA:function(b,
a,e,c,d){this.G(b,a,e,c,d)},idy:function(b,a,e,c,d){this.a.g(b,a,e,c,d)},idW:function(b,a,e,c,d,g){this.a.E(b,a,e,c,d,g)},idX:function(b,a,e,c,d,g){this.a.E(b,a,e,c,d,g)},idY:function(b,a,e,c,d,g){var f=(new j.e)._01e(0,0),h=this.a.e();this.a.Z(c.x,c.y);this.a.W(g);this.a.C(b,a,e,j.e.e(f),d);this.a.se(h)},idZ:function(b,a,e,c,d,g){var f=d.b(),h=d.d(),i=0,l=0,i=1==f?c.x+(c.w+1)/2:0==f&&0==(d.c()&1)?c.x:c.g(),l=1==h?c.y+(c.h+1)/2:0==h?c.y:c.c();this.id0(b,a,e,c,d,g,(new j.f)._01f(i,l))},id0:function(b,
a,e,c,d,g,f){var h=this.a.e();this.a.Z(f.x,f.y);this.a.W(g);c=c._nc();c.m(-f.x,-f.y);this.a.D(b,a,e,c,d);this.a.se(h)},idw:function(b,a,e,c,d,g,f){this.H(b,a,e,c,d,g,f)},idx:function(b,a,e,c,d,g,f){this.H(b,a,e,c,d,g,f)},idG:function(b,a,e,c,d,g,f,h){this.a.o(b,a,e,c,d,g,f,h)},idH:function(b,a,e,c,d,g,f,h){this.a.p(b,(new j.c)._02c(a.x,a.y,a.w,a.h),e,c,d,g,f,h)},w:function(b){this.A=b;for(var a=Array(5),b=0.0174533*b-0.0349066,e=0;e<a.length;e++)a[e]=j.a.q(b),b+=0.0174533;return a},I:function(b){var a=
(new j.aE)._0aE();a.x(b);return a},f:function(){null!=this.v&&this.v.iad(1048608)},p:function(b,a,e,c,d){if(!this.h||this.q)return!1;b=j.W.D(b,j.au);return null==b||0==b.j().a||16>c&&16>d?!1:!0}};v._dt("CWHH",j.Sy,0,t.icA,t.ido,j.Su)})();