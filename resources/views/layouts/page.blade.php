<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel | Page Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://massager.test/css/laravel-grapes.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }
        </style>
        <script>
             !function(t,r){"object"==typeof exports&&"undefined"!=typeof module?module.exports=r():"function"==typeof define&&define.amd?define(r):(t||self).route=r()}(this,function(){function t(t,r){for(var e=0;e<r.length;e++){var n=r[e];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}function r(r,e,n){return e&&t(r.prototype,e),n&&t(r,n),Object.defineProperty(r,"prototype",{writable:!1}),r}function e(){return e=Object.assign?Object.assign.bind():function(t){for(var r=1;r<arguments.length;r++){var e=arguments[r];for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]=e[n])}return t},e.apply(this,arguments)}function n(t){return n=Object.setPrototypeOf?Object.getPrototypeOf.bind():function(t){return t.__proto__||Object.getPrototypeOf(t)},n(t)}function o(t,r){return o=Object.setPrototypeOf?Object.setPrototypeOf.bind():function(t,r){return t.__proto__=r,t},o(t,r)}function i(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(t){return!1}}function u(t,r,e){return u=i()?Reflect.construct.bind():function(t,r,e){var n=[null];n.push.apply(n,r);var i=new(Function.bind.apply(t,n));return e&&o(i,e.prototype),i},u.apply(null,arguments)}function f(t){var r="function"==typeof Map?new Map:void 0;return f=function(t){if(null===t||-1===Function.toString.call(t).indexOf("[native code]"))return t;if("function"!=typeof t)throw new TypeError("Super expression must either be null or a function");if(void 0!==r){if(r.has(t))return r.get(t);r.set(t,e)}function e(){return u(t,arguments,n(this).constructor)}return e.prototype=Object.create(t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),o(e,t)},f(t)}var a=String.prototype.replace,c=/%20/g,l="RFC3986",s={default:l,formatters:{RFC1738:function(t){return a.call(t,c,"+")},RFC3986:function(t){return String(t)}},RFC1738:"RFC1738",RFC3986:l},v=Object.prototype.hasOwnProperty,p=Array.isArray,y=function(){for(var t=[],r=0;r<256;++r)t.push("%"+((r<16?"0":"")+r.toString(16)).toUpperCase());return t}(),d=function(t,r){for(var e=r&&r.plainObjects?Object.create(null):{},n=0;n<t.length;++n)void 0!==t[n]&&(e[n]=t[n]);return e},b={arrayToObject:d,assign:function(t,r){return Object.keys(r).reduce(function(t,e){return t[e]=r[e],t},t)},combine:function(t,r){return[].concat(t,r)},compact:function(t){for(var r=[{obj:{o:t},prop:"o"}],e=[],n=0;n<r.length;++n)for(var o=r[n],i=o.obj[o.prop],u=Object.keys(i),f=0;f<u.length;++f){var a=u[f],c=i[a];"object"==typeof c&&null!==c&&-1===e.indexOf(c)&&(r.push({obj:i,prop:a}),e.push(c))}return function(t){for(;t.length>1;){var r=t.pop(),e=r.obj[r.prop];if(p(e)){for(var n=[],o=0;o<e.length;++o)void 0!==e[o]&&n.push(e[o]);r.obj[r.prop]=n}}}(r),t},decode:function(t,r,e){var n=t.replace(/\+/g," ");if("iso-8859-1"===e)return n.replace(/%[0-9a-f]{2}/gi,unescape);try{return decodeURIComponent(n)}catch(t){return n}},encode:function(t,r,e,n,o){if(0===t.length)return t;var i=t;if("symbol"==typeof t?i=Symbol.prototype.toString.call(t):"string"!=typeof t&&(i=String(t)),"iso-8859-1"===e)return escape(i).replace(/%u[0-9a-f]{4}/gi,function(t){return"%26%23"+parseInt(t.slice(2),16)+"%3B"});for(var u="",f=0;f<i.length;++f){var a=i.charCodeAt(f);45===a||46===a||95===a||126===a||a>=48&&a<=57||a>=65&&a<=90||a>=97&&a<=122||o===s.RFC1738&&(40===a||41===a)?u+=i.charAt(f):a<128?u+=y[a]:a<2048?u+=y[192|a>>6]+y[128|63&a]:a<55296||a>=57344?u+=y[224|a>>12]+y[128|a>>6&63]+y[128|63&a]:(a=65536+((1023&a)<<10|1023&i.charCodeAt(f+=1)),u+=y[240|a>>18]+y[128|a>>12&63]+y[128|a>>6&63]+y[128|63&a])}return u},isBuffer:function(t){return!(!t||"object"!=typeof t||!(t.constructor&&t.constructor.isBuffer&&t.constructor.isBuffer(t)))},isRegExp:function(t){return"[object RegExp]"===Object.prototype.toString.call(t)},maybeMap:function(t,r){if(p(t)){for(var e=[],n=0;n<t.length;n+=1)e.push(r(t[n]));return e}return r(t)},merge:function t(r,e,n){if(!e)return r;if("object"!=typeof e){if(p(r))r.push(e);else{if(!r||"object"!=typeof r)return[r,e];(n&&(n.plainObjects||n.allowPrototypes)||!v.call(Object.prototype,e))&&(r[e]=!0)}return r}if(!r||"object"!=typeof r)return[r].concat(e);var o=r;return p(r)&&!p(e)&&(o=d(r,n)),p(r)&&p(e)?(e.forEach(function(e,o){if(v.call(r,o)){var i=r[o];i&&"object"==typeof i&&e&&"object"==typeof e?r[o]=t(i,e,n):r.push(e)}else r[o]=e}),r):Object.keys(e).reduce(function(r,o){var i=e[o];return r[o]=v.call(r,o)?t(r[o],i,n):i,r},o)}},h=Object.prototype.hasOwnProperty,m={brackets:function(t){return t+"[]"},comma:"comma",indices:function(t,r){return t+"["+r+"]"},repeat:function(t){return t}},g=Array.isArray,j=String.prototype.split,w=Array.prototype.push,O=function(t,r){w.apply(t,g(r)?r:[r])},E=Date.prototype.toISOString,R=s.default,S={addQueryPrefix:!1,allowDots:!1,charset:"utf-8",charsetSentinel:!1,delimiter:"&",encode:!0,encoder:b.encode,encodeValuesOnly:!1,format:R,formatter:s.formatters[R],indices:!1,serializeDate:function(t){return E.call(t)},skipNulls:!1,strictNullHandling:!1},T=function t(r,e,n,o,i,u,f,a,c,l,s,v,p,y){var d,h=r;if("function"==typeof f?h=f(e,h):h instanceof Date?h=l(h):"comma"===n&&g(h)&&(h=b.maybeMap(h,function(t){return t instanceof Date?l(t):t})),null===h){if(o)return u&&!p?u(e,S.encoder,y,"key",s):e;h=""}if("string"==typeof(d=h)||"number"==typeof d||"boolean"==typeof d||"symbol"==typeof d||"bigint"==typeof d||b.isBuffer(h)){if(u){var m=p?e:u(e,S.encoder,y,"key",s);if("comma"===n&&p){for(var w=j.call(String(h),","),E="",R=0;R<w.length;++R)E+=(0===R?"":",")+v(u(w[R],S.encoder,y,"value",s));return[v(m)+"="+E]}return[v(m)+"="+v(u(h,S.encoder,y,"value",s))]}return[v(e)+"="+v(String(h))]}var T,k=[];if(void 0===h)return k;if("comma"===n&&g(h))T=[{value:h.length>0?h.join(",")||null:void 0}];else if(g(f))T=f;else{var x=Object.keys(h);T=a?x.sort(a):x}for(var N=0;N<T.length;++N){var C=T[N],D="object"==typeof C&&void 0!==C.value?C.value:h[C];if(!i||null!==D){var F=g(h)?"function"==typeof n?n(e,C):e:e+(c?"."+C:"["+C+"]");O(k,t(D,F,n,o,i,u,f,a,c,l,s,v,p,y))}}return k},k=Object.prototype.hasOwnProperty,x=Array.isArray,N={allowDots:!1,allowPrototypes:!1,arrayLimit:20,charset:"utf-8",charsetSentinel:!1,comma:!1,decoder:b.decode,delimiter:"&",depth:5,ignoreQueryPrefix:!1,interpretNumericEntities:!1,parameterLimit:1e3,parseArrays:!0,plainObjects:!1,strictNullHandling:!1},C=function(t){return t.replace(/&#(\d+);/g,function(t,r){return String.fromCharCode(parseInt(r,10))})},D=function(t,r){return t&&"string"==typeof t&&r.comma&&t.indexOf(",")>-1?t.split(","):t},F=function(t,r,e,n){if(t){var o=e.allowDots?t.replace(/\.([^.[]+)/g,"[$1]"):t,i=/(\[[^[\]]*])/g,u=e.depth>0&&/(\[[^[\]]*])/.exec(o),f=u?o.slice(0,u.index):o,a=[];if(f){if(!e.plainObjects&&k.call(Object.prototype,f)&&!e.allowPrototypes)return;a.push(f)}for(var c=0;e.depth>0&&null!==(u=i.exec(o))&&c<e.depth;){if(c+=1,!e.plainObjects&&k.call(Object.prototype,u[1].slice(1,-1))&&!e.allowPrototypes)return;a.push(u[1])}return u&&a.push("["+o.slice(u.index)+"]"),function(t,r,e,n){for(var o=n?r:D(r,e),i=t.length-1;i>=0;--i){var u,f=t[i];if("[]"===f&&e.parseArrays)u=[].concat(o);else{u=e.plainObjects?Object.create(null):{};var a="["===f.charAt(0)&&"]"===f.charAt(f.length-1)?f.slice(1,-1):f,c=parseInt(a,10);e.parseArrays||""!==a?!isNaN(c)&&f!==a&&String(c)===a&&c>=0&&e.parseArrays&&c<=e.arrayLimit?(u=[])[c]=o:"__proto__"!==a&&(u[a]=o):u={0:o}}o=u}return o}(a,r,e,n)}},$=function(t,r){var e=function(t){if(!t)return N;if(null!=t.decoder&&"function"!=typeof t.decoder)throw new TypeError("Decoder has to be a function.");if(void 0!==t.charset&&"utf-8"!==t.charset&&"iso-8859-1"!==t.charset)throw new TypeError("The charset option must be either utf-8, iso-8859-1, or undefined");return{allowDots:void 0===t.allowDots?N.allowDots:!!t.allowDots,allowPrototypes:"boolean"==typeof t.allowPrototypes?t.allowPrototypes:N.allowPrototypes,arrayLimit:"number"==typeof t.arrayLimit?t.arrayLimit:N.arrayLimit,charset:void 0===t.charset?N.charset:t.charset,charsetSentinel:"boolean"==typeof t.charsetSentinel?t.charsetSentinel:N.charsetSentinel,comma:"boolean"==typeof t.comma?t.comma:N.comma,decoder:"function"==typeof t.decoder?t.decoder:N.decoder,delimiter:"string"==typeof t.delimiter||b.isRegExp(t.delimiter)?t.delimiter:N.delimiter,depth:"number"==typeof t.depth||!1===t.depth?+t.depth:N.depth,ignoreQueryPrefix:!0===t.ignoreQueryPrefix,interpretNumericEntities:"boolean"==typeof t.interpretNumericEntities?t.interpretNumericEntities:N.interpretNumericEntities,parameterLimit:"number"==typeof t.parameterLimit?t.parameterLimit:N.parameterLimit,parseArrays:!1!==t.parseArrays,plainObjects:"boolean"==typeof t.plainObjects?t.plainObjects:N.plainObjects,strictNullHandling:"boolean"==typeof t.strictNullHandling?t.strictNullHandling:N.strictNullHandling}}(r);if(""===t||null==t)return e.plainObjects?Object.create(null):{};for(var n="string"==typeof t?function(t,r){var e,n={},o=(r.ignoreQueryPrefix?t.replace(/^\?/,""):t).split(r.delimiter,Infinity===r.parameterLimit?void 0:r.parameterLimit),i=-1,u=r.charset;if(r.charsetSentinel)for(e=0;e<o.length;++e)0===o[e].indexOf("utf8=")&&("utf8=%E2%9C%93"===o[e]?u="utf-8":"utf8=%26%2310003%3B"===o[e]&&(u="iso-8859-1"),i=e,e=o.length);for(e=0;e<o.length;++e)if(e!==i){var f,a,c=o[e],l=c.indexOf("]="),s=-1===l?c.indexOf("="):l+1;-1===s?(f=r.decoder(c,N.decoder,u,"key"),a=r.strictNullHandling?null:""):(f=r.decoder(c.slice(0,s),N.decoder,u,"key"),a=b.maybeMap(D(c.slice(s+1),r),function(t){return r.decoder(t,N.decoder,u,"value")})),a&&r.interpretNumericEntities&&"iso-8859-1"===u&&(a=C(a)),c.indexOf("[]=")>-1&&(a=x(a)?[a]:a),n[f]=k.call(n,f)?b.combine(n[f],a):a}return n}(t,e):t,o=e.plainObjects?Object.create(null):{},i=Object.keys(n),u=0;u<i.length;++u){var f=i[u],a=F(f,n[f],e,"string"==typeof t);o=b.merge(o,a,e)}return b.compact(o)},A=/*#__PURE__*/function(){function t(t,r,e){var n,o;this.name=t,this.definition=r,this.bindings=null!=(n=r.bindings)?n:{},this.wheres=null!=(o=r.wheres)?o:{},this.config=e}var e=t.prototype;return e.matchesUrl=function(t){var r=this;if(!this.definition.methods.includes("GET"))return!1;var e=this.template.replace(/(\/?){([^}?]*)(\??)}/g,function(t,e,n,o){var i,u="(?<"+n+">"+((null==(i=r.wheres[n])?void 0:i.replace(/(^\^)|(\$$)/g,""))||"[^/?]+")+")";return o?"("+e+u+")?":""+e+u}).replace(/^\w+:\/\//,""),n=t.replace(/^\w+:\/\//,"").split("?"),o=n[0],i=n[1],u=new RegExp("^"+e+"/?$").exec(o);return!!u&&{params:u.groups,query:$(i)}},e.compile=function(t){var r=this,e=this.parameterSegments;return e.length?this.template.replace(/{([^}?]+)(\??)}/g,function(n,o,i){var u,f,a;if(!i&&[null,void 0].includes(t[o]))throw new Error("Ziggy error: '"+o+"' parameter is required for route '"+r.name+"'.");if(e[e.length-1].name===o&&".*"===r.wheres[o])return encodeURIComponent(null!=(a=t[o])?a:"").replace(/%2F/g,"/");if(r.wheres[o]&&!new RegExp("^"+(i?"("+r.wheres[o]+")?":r.wheres[o])+"$").test(null!=(u=t[o])?u:""))throw new Error("Ziggy error: '"+o+"' parameter does not match required format '"+r.wheres[o]+"' for route '"+r.name+"'.");return encodeURIComponent(null!=(f=t[o])?f:"")}).replace(/\/+$/,""):this.template},r(t,[{key:"template",get:function(){return((this.config.absolute?this.definition.domain?""+this.config.url.match(/^\w+:\/\//)[0]+this.definition.domain+(this.config.port?":"+this.config.port:""):this.config.url:"")+"/"+this.definition.uri).replace(/\/+$/,"")}},{key:"parameterSegments",get:function(){var t,r;return null!=(t=null==(r=this.template.match(/{[^}?]+\??}/g))?void 0:r.map(function(t){return{name:t.replace(/{|\??}/g,""),required:!/\?}$/.test(t)}}))?t:[]}}]),t}(),P=/*#__PURE__*/function(t){var n,i;function u(r,n,o,i){var u;if(void 0===o&&(o=!0),(u=t.call(this)||this).t=null!=i?i:"undefined"!=typeof Ziggy?Ziggy:null==globalThis?void 0:globalThis.Ziggy,u.t=e({},u.t,{absolute:o}),r){if(!u.t.routes[r])throw new Error("Ziggy error: route '"+r+"' is not in the route list.");u.i=new A(r,u.t.routes[r],u.t),u.u=u.l(n)}return u}i=t,(n=u).prototype=Object.create(i.prototype),n.prototype.constructor=n,o(n,i);var f=u.prototype;return f.toString=function(){var t=this,r=Object.keys(this.u).filter(function(r){return!t.i.parameterSegments.some(function(t){return t.name===r})}).filter(function(t){return"_query"!==t}).reduce(function(r,n){var o;return e({},r,((o={})[n]=t.u[n],o))},{});return this.i.compile(this.u)+function(t,r){var e,n=t,o=function(t){if(!t)return S;if(null!=t.encoder&&"function"!=typeof t.encoder)throw new TypeError("Encoder has to be a function.");var r=t.charset||S.charset;if(void 0!==t.charset&&"utf-8"!==t.charset&&"iso-8859-1"!==t.charset)throw new TypeError("The charset option must be either utf-8, iso-8859-1, or undefined");var e=s.default;if(void 0!==t.format){if(!h.call(s.formatters,t.format))throw new TypeError("Unknown format option provided.");e=t.format}var n=s.formatters[e],o=S.filter;return("function"==typeof t.filter||g(t.filter))&&(o=t.filter),{addQueryPrefix:"boolean"==typeof t.addQueryPrefix?t.addQueryPrefix:S.addQueryPrefix,allowDots:void 0===t.allowDots?S.allowDots:!!t.allowDots,charset:r,charsetSentinel:"boolean"==typeof t.charsetSentinel?t.charsetSentinel:S.charsetSentinel,delimiter:void 0===t.delimiter?S.delimiter:t.delimiter,encode:"boolean"==typeof t.encode?t.encode:S.encode,encoder:"function"==typeof t.encoder?t.encoder:S.encoder,encodeValuesOnly:"boolean"==typeof t.encodeValuesOnly?t.encodeValuesOnly:S.encodeValuesOnly,filter:o,format:e,formatter:n,serializeDate:"function"==typeof t.serializeDate?t.serializeDate:S.serializeDate,skipNulls:"boolean"==typeof t.skipNulls?t.skipNulls:S.skipNulls,sort:"function"==typeof t.sort?t.sort:null,strictNullHandling:"boolean"==typeof t.strictNullHandling?t.strictNullHandling:S.strictNullHandling}}(r);"function"==typeof o.filter?n=(0,o.filter)("",n):g(o.filter)&&(e=o.filter);var i=[];if("object"!=typeof n||null===n)return"";var u=m[r&&r.arrayFormat in m?r.arrayFormat:r&&"indices"in r?r.indices?"indices":"repeat":"indices"];e||(e=Object.keys(n)),o.sort&&e.sort(o.sort);for(var f=0;f<e.length;++f){var a=e[f];o.skipNulls&&null===n[a]||O(i,T(n[a],a,u,o.strictNullHandling,o.skipNulls,o.encode?o.encoder:null,o.filter,o.sort,o.allowDots,o.serializeDate,o.format,o.formatter,o.encodeValuesOnly,o.charset))}var c=i.join(o.delimiter),l=!0===o.addQueryPrefix?"?":"";return o.charsetSentinel&&(l+="iso-8859-1"===o.charset?"utf8=%26%2310003%3B&":"utf8=%E2%9C%93&"),c.length>0?l+c:""}(e({},r,this.u._query),{addQueryPrefix:!0,arrayFormat:"indices",encodeValuesOnly:!0,skipNulls:!0,encoder:function(t,r){return"boolean"==typeof t?Number(t):r(t)}})},f.v=function(t){var r=this;t?this.t.absolute&&t.startsWith("/")&&(t=this.p().host+t):t=this.h();var n={},o=Object.entries(this.t.routes).find(function(e){return n=new A(e[0],e[1],r.t).matchesUrl(t)})||[void 0,void 0];return e({name:o[0]},n,{route:o[1]})},f.h=function(){var t=this.p(),r=t.pathname,e=t.search;return(this.t.absolute?t.host+r:r.replace(this.t.url.replace(/^\w*:\/\/[^/]+/,""),"").replace(/^\/+/,"/"))+e},f.current=function(t,r){var n=this.v(),o=n.name,i=n.params,u=n.query,f=n.route;if(!t)return o;var a=new RegExp("^"+t.replace(/\./g,"\\.").replace(/\*/g,".*")+"$").test(o);if([null,void 0].includes(r)||!a)return a;var c=new A(o,f,this.t);r=this.l(r,c);var l=e({},i,u);return!(!Object.values(r).every(function(t){return!t})||Object.values(l).some(function(t){return void 0!==t}))||Object.entries(r).every(function(t){return l[t[0]]==t[1]})},f.p=function(){var t,r,e,n,o,i,u="undefined"!=typeof window?window.location:{},f=u.host,a=u.pathname,c=u.search;return{host:null!=(t=null==(r=this.t.location)?void 0:r.host)?t:void 0===f?"":f,pathname:null!=(e=null==(n=this.t.location)?void 0:n.pathname)?e:void 0===a?"":a,search:null!=(o=null==(i=this.t.location)?void 0:i.search)?o:void 0===c?"":c}},f.has=function(t){return Object.keys(this.t.routes).includes(t)},f.l=function(t,r){var n=this;void 0===t&&(t={}),void 0===r&&(r=this.i),null!=t||(t={}),t=["string","number"].includes(typeof t)?[t]:t;var o=r.parameterSegments.filter(function(t){return!n.t.defaults[t.name]});if(Array.isArray(t))t=t.reduce(function(t,r,n){var i,u;return e({},t,o[n]?((i={})[o[n].name]=r,i):"object"==typeof r?r:((u={})[r]="",u))},{});else if(1===o.length&&!t[o[0].name]&&(t.hasOwnProperty(Object.values(r.bindings)[0])||t.hasOwnProperty("id"))){var i;(i={})[o[0].name]=t,t=i}return e({},this.m(r),this.g(t,r))},f.m=function(t){var r=this;return t.parameterSegments.filter(function(t){return r.t.defaults[t.name]}).reduce(function(t,n,o){var i,u=n.name;return e({},t,((i={})[u]=r.t.defaults[u],i))},{})},f.g=function(t,r){var n=r.bindings,o=r.parameterSegments;return Object.entries(t).reduce(function(t,r){var i,u,f=r[0],a=r[1];if(!a||"object"!=typeof a||Array.isArray(a)||!o.some(function(t){return t.name===f}))return e({},t,((u={})[f]=a,u));if(!a.hasOwnProperty(n[f])){if(!a.hasOwnProperty("id"))throw new Error("Ziggy error: object passed as '"+f+"' parameter is missing route model binding key '"+n[f]+"'.");n[f]="id"}return e({},t,((i={})[f]=a[n[f]],i))},{})},f.valueOf=function(){return this.toString()},f.check=function(t){return this.has(t)},r(u,[{key:"params",get:function(){var t=this.v();return e({},t.params,t.query)}}]),u}(/*#__PURE__*/f(String));return function(t,r,e,n){var o=new P(t,r,e,n);return t?o.toString():o}});

            </script>

</head>
<body>
    <input id="Pages" type="hidden" 
           pages-data="[
           {"id":2,"name":null,"slug":"pack"},
           {"id":3,"name":null,"slug":"contact"},
           {"id":4,"name":null,"slug":"about"},
           {"id":5,"name":"test","slug":"test"},
           {"id":6,"name":null,"slug":"feature"},
           {"id":7,"name":null,"slug":"how-to-work"},
           {"id":8,"name":"jkjjk","slug":"jkjjk"},
           {"id":9,"name":"jkjjkfffffffff","slug":"jkjjkfffffffff"}
           ]">
    <input id="Languages" type="hidden" lang-data="[]">
    <div id="gjs" style="height:100%; overflow:hidden" class="gjs-editor-cont"></div>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="mr-auto"></strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" style="outline:0;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="http://massager.test/js/laravel-grapes.js"></script>
<script>
       var lp = './img/';
      var plp = 'https://via.placeholder.com/350x250/';
      var images = [
        lp + 'team1.jpg',
        lp + 'team2.jpg',
        lp + 'team3.jpg',
        plp + '78c5d6/fff',
        plp + '459ba8/fff',
        plp + '79c267/fff',
        plp + 'c5d647/fff',
        plp + 'f28c33/fff',
        plp + 'e868a2/fff',
        plp + 'cc4360/fff',
        lp + 'work-desk.jpg',
        lp + 'phone-app.png',
        lp + 'bg-gr-v.png'
      ];

      var editor  = grapesjs.init({
        height: '100%',
        container : '#gjs',
        fromElement: true,
        showOffsets: true,
         panels: { defaults: [] },
         assetManager: {
          embedAsBase64: true,
          assets: images
        },
        selectorManager: { componentFirst: true },
        
        styleManager: {
          sectors: [{
              name: 'General',
              properties:[
                {
                  extend: 'float',
                  type: 'radio',
                  default: 'none',
                  options: [
                    { value: 'none', className: 'fa fa-times'},
                    { value: 'left', className: 'fa fa-align-left'},
                    { value: 'right', className: 'fa fa-align-right'}
                  ],
                },
                'display',
                { extend: 'position', type: 'select' },
                'top',
                'right',
                'left',
                'bottom',
              ],
            }, 
            {
                name: 'Dimension',
                open: false,
                properties: [
                  'width',
                  {
                    id: 'flex-width',
                    type: 'integer',
                    name: 'Width',
                    units: ['px', '%'],
                    property: 'flex-basis',
                    toRequire: 1,
                  },
                  'height',
                  'max-width',
                  'min-height',
                  'margin',
                  'padding'
                ],
              },
              {
                name: 'Typography',
                open: false,
                properties: [
                    'font-family',
                    'font-size',
                    'font-weight',
                    'letter-spacing',
                    'color',
                    'line-height',
                    {
                      extend: 'text-align',
                      options: [
                        { id : 'left',  label : 'Left',    className: 'fa fa-align-left'},
                        { id : 'center',  label : 'Center',  className: 'fa fa-align-center' },
                        { id : 'right',   label : 'Right',   className: 'fa fa-align-right'},
                        { id : 'justify', label : 'Justify',   className: 'fa fa-align-justify'}
                      ],
                    },
                    {
                      property: 'text-decoration',
                      type: 'radio',
                      default: 'none',
                      options: [
                        { id: 'none', label: 'None', className: 'fa fa-times'},
                        { id: 'underline', label: 'underline', className: 'fa fa-underline' },
                        { id: 'line-through', label: 'Line-through', className: 'fa fa-strikethrough'}
                      ],
                    },
                    'text-shadow'
                ],
              },
              {
                name: 'Decorations',
                open: false,
                properties: [
                  'opacity',
                  'border-radius',
                  'border',
                  'box-shadow',
                  'background', // { id: 'background-bg', property: 'background', type: 'bg' }
                ],
              },
              {
                name: 'Extra',
                open: false,
                buildProps: [
                  'transition',
                  'perspective',
                  'transform'
                ],
              },
              {
                name: 'Flex',
                open: false,
                properties: [{
                  name: 'Flex Container',
                  property: 'display',
                  type: 'select',
                  defaults: 'block',
                  list: [
                    { value: 'block', name: 'Disable'},
                    { value: 'flex', name: 'Enable'}
                  ],
                },{
                  name: 'Flex Parent',
                  property: 'label-parent-flex',
                  type: 'integer',
                },{
                  name: 'Direction',
                  property: 'flex-direction',
                  type: 'radio',
                  defaults: 'row',
                  list: [{
                    value: 'row',
                    name: 'Row',
                    className: 'icons-flex icon-dir-row',
                    title: 'Row',
                  },{
                    value: 'row-reverse',
                    name: 'Row reverse',
                    className: 'icons-flex icon-dir-row-rev',
                    title: 'Row reverse',
                  },{
                    value: 'column',
                    name: 'Column',
                    title: 'Column',
                    className: 'icons-flex icon-dir-col',
                  },{
                    value: 'column-reverse',
                    name: 'Column reverse',
                    title: 'Column reverse',
                    className: 'icons-flex icon-dir-col-rev',
                  }],
                },{
                  name: 'Justify',
                  property: 'justify-content',
                  type: 'radio',
                  defaults: 'flex-start',
                  list: [{
                    value: 'flex-start',
                    className: 'icons-flex icon-just-start',
                    title: 'Start',
                  },{
                    value: 'flex-end',
                    title: 'End',
                    className: 'icons-flex icon-just-end',
                  },{
                    value: 'space-between',
                    title: 'Space between',
                    className: 'icons-flex icon-just-sp-bet',
                  },{
                    value: 'space-around',
                    title: 'Space around',
                    className: 'icons-flex icon-just-sp-ar',
                  },{
                    value: 'center',
                    title: 'Center',
                    className: 'icons-flex icon-just-sp-cent',
                  }],
                },{
                  name: 'Align',
                  property: 'align-items',
                  type: 'radio',
                  defaults: 'center',
                  list: [{
                    value: 'flex-start',
                    title: 'Start',
                    className: 'icons-flex icon-al-start',
                  },{
                    value: 'flex-end',
                    title: 'End',
                    className: 'icons-flex icon-al-end',
                  },{
                    value: 'stretch',
                    title: 'Stretch',
                    className: 'icons-flex icon-al-str',
                  },{
                    value: 'center',
                    title: 'Center',
                    className: 'icons-flex icon-al-center',
                  }],
                },{
                  name: 'Flex Children',
                  property: 'label-parent-flex',
                  type: 'integer',
                },{
                  name: 'Order',
                  property: 'order',
                  type: 'integer',
                  defaults: 0,
                  min: 0
                },{
                  name: 'Flex',
                  property: 'flex',
                  type: 'composite',
                  properties  : [{
                    name: 'Grow',
                    property: 'flex-grow',
                    type: 'integer',
                    defaults: 0,
                    min: 0
                  },{
                    name: 'Shrink',
                    property: 'flex-shrink',
                    type: 'integer',
                    defaults: 0,
                    min: 0
                  },{
                    name: 'Basis',
                    property: 'flex-basis',
                    type: 'integer',
                    units: ['px','%',''],
                    unit: '',
                    defaults: 'auto',
                  }],
                },{
                  name: 'Align',
                  property: 'align-self',
                  type: 'radio',
                  defaults: 'auto',
                  list: [{
                    value: 'auto',
                    name: 'Auto',
                  },{
                    value: 'flex-start',
                    title: 'Start',
                    className: 'icons-flex icon-al-start',
                  },{
                    value   : 'flex-end',
                    title: 'End',
                    className: 'icons-flex icon-al-end',
                  },{
                    value   : 'stretch',
                    title: 'Stretch',
                    className: 'icons-flex icon-al-str',
                  },{
                    value   : 'center',
                    title: 'Center',
                    className: 'icons-flex icon-al-center',
                  }],
                }]
              }
            ],
        },
        plugins: [
          'gjs-blocks-basic',
          'grapesjs-plugin-forms',
          'grapesjs-component-countdown',
          'grapesjs-plugin-export',
          'grapesjs-tabs',
          'grapesjs-custom-code',
          'grapesjs-touch',
          'grapesjs-parser-postcss',
          'grapesjs-tooltip',
          'grapesjs-tui-image-editor',
          'grapesjs-typed',
          'grapesjs-style-bg',
          'grapesjs-preset-webpage',
        ],
        pluginsOpts: {
          'gjs-blocks-basic': { flexGrid: true },
          'grapesjs-tui-image-editor': {
            script: [
              // 'https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.7/fabric.min.js',
              'https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js',
              'https://uicdn.toast.com/tui-color-picker/v2.2.7/tui-color-picker.min.js',
              'https://uicdn.toast.com/tui-image-editor/v3.15.2/tui-image-editor.min.js'
            ],
            style: [
              'https://uicdn.toast.com/tui-color-picker/v2.2.7/tui-color-picker.min.css',
              'https://uicdn.toast.com/tui-image-editor/v3.15.2/tui-image-editor.min.css',
            ],
          },
          'grapesjs-tabs': {
            tabsBlock: { category: 'Extra' }
          },
          'grapesjs-typed': {
            block: {
              category: 'Extra',
              content: {
                type: 'typed',
                'type-speed': 40,
                strings: [
                  'Text row one',
                  'Text row two',
                  'Text row three',
                ],
              }
            }
          },
          'grapesjs-preset-webpage': {
            modalImportTitle: 'Import Template',
            modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
            modalImportContent: function(editor) {
              return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
            },
          },
        },
      });
      

      editor.I18n.addMessages({
        en: {
          styleManager: {
            properties: {
              'background-repeat': 'Repeat',
              'background-position': 'Position',
              'background-attachment': 'Attachment',
              'background-size': 'Size',
            }
          },
        }
      });

      var pn = editor.Panels;
      var modal = editor.Modal;
      var cmdm = editor.Commands;

      // Update canvas-clear command
      cmdm.add('canvas-clear', function() {
        if(confirm('Are you sure to clean the canvas?')) {
          editor.runCommand('core:canvas-clear')
          setTimeout(function(){ localStorage.clear()}, 0)
        }
      });

      // Add info command
      var mdlClass = 'gjs-mdl-dialog-sm';
      var infoContainer = document.getElementById('info-panel');

      cmdm.add('open-info', function() {
        var mdlDialog = document.querySelector('.gjs-mdl-dialog');
        mdlDialog.className += ' ' + mdlClass;
        infoContainer.style.display = 'block';
        modal.setTitle('About this demo');
        modal.setContent(infoContainer);
        modal.open();
        modal.getModel().once('change:open', function() {
          mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
        })
      });

      pn.addButton('options',
      {
        id: 'open-info',
        className: 'fa fa-save',
        command: function() { editor.runCommand('open-info') },
        attributes: {
          'title': 'save',
          'data-tooltip-pos': 'bottom',
        },
      },
      
      );


      // Simple warn notifier
      var origWarn = console.warn;
      toastr.options = {
        closeButton: true,
        preventDuplicates: true,
        showDuration: 250,
        hideDuration: 150
      };
      console.warn = function (msg) {
        if (msg.indexOf('[undefined]') == -1) {
          toastr.warning(msg);
        }
        origWarn(msg);
      };


      // Add and beautify tooltips
      [
      ['sw-visibility', 'Show Borders'],
      ['preview', 'Preview'], 
      ['fullscreen', 'Fullscreen'],
       ['export-template', 'Export'],
       ['undo', 'Undo'], 
       ['redo', 'Redo'],
       ['gjs-open-import-webpage', 'Import'],
       ['canvas-clear', 'Clear canvas'],''
       ]
      .forEach(function(item) {
        pn.getButton('options', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      [
      ['open-sm', 'Style Manager'],
      ['open-layers', 'Layers'], 
      ['open-blocks', 'Blocks']
      ]
      .forEach(function(item) {
        pn.getButton('views', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      var titles = document.querySelectorAll('*[title]');

      for (var i = 0; i < titles.length; i++) {
        var el = titles[i];
        var title = el.getAttribute('title');
        title = title ? title.trim(): '';
        if(!title)
          break;
        el.setAttribute('data-tooltip', title);
        el.setAttribute('title', '');
      }


      // Store and load events
      editor.on('storage:load', function(e) { console.log('Loaded ', e) });
      editor.on('storage:store', function(e) { console.log('Stored ', e) });


      // Do stuff on load
      editor.on('load', function() {
        var $ = grapesjs.$;

        // Show borders by default
        pn.getButton('options', 'sw-visibility').set('active', 1);

        // Show logo with the version
        var logoCont = document.querySelector('.gjs-logo-cont');
        document.querySelector('.gjs-logo-version').innerHTML = 'v' + grapesjs.version;
        var logoPanel = document.querySelector('.gjs-pn-commands');
        logoPanel.appendChild(logoCont);


        // Load and show settings and style manager
        var openTmBtn = pn.getButton('views', 'open-tm');
        openTmBtn && openTmBtn.set('active', 1);
        var openSm = pn.getButton('views', 'open-sm');
        openSm && openSm.set('active', 1);

        // Remove trait view
        pn.removeButton('views', 'open-tm');

        // Add Settings Sector
        var traitsSector = $('<div class="gjs-sm-sector no-select">'+
          '<div class="gjs-sm-sector-title"><span class="icon-settings fa fa-cog"></span>\n\
                <span class="gjs-sm-sector-label">Settings</span></div>' +
          '<div class="gjs-sm-properties" style="display: none;"></div></div>'
          
          
                            );
        var traitsProps = traitsSector.find('.gjs-sm-properties');
        traitsProps.append($('.gjs-trt-traits'));
        $('.gjs-sm-sectors').before(traitsSector);
        traitsSector.find('.gjs-sm-sector-title').on('click', function(){
          var traitStyle = traitsProps.get(0).style;
          var hidden = traitStyle.display == 'none';
          if (hidden) {
            traitStyle.display = 'block';
          } else {
            traitStyle.display = 'none';
          }
        });

        // Open block manager
        var openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
        openBlocksBtn && openBlocksBtn.set('active', 1);

        // Move Ad
        $('#gjs').append($('.ad-cont'));
      });
      

      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-74284223-1', 'auto');
      ga('send', 'pageview');
    </script>
</body>
</html>