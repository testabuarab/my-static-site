const getPrototypeOf = Object.getPrototypeOf;
const hasProto = (v, constructor, predicate) => {
	let _a;

	if (predicate(v, constructor.prototype)) {
		return true;
	} else {
		return ((_a = v.constructor) === null || _a === void 0 ? void 0 : _a.name) === constructor.name;
	}
};

const typeOf = x => {
	const t = typeof x;

	if (x === null) {
		return 'null';
	} else if (t === 'object' && Array.isArray(x)) {
		return 'array';
	} else if (t === 'object' && hasProto(x, String, (o, proto) => proto.isPrototypeOf(o))) {
		return 'string';
	} else {
		return t;
	}
};

const isType = type => value => typeOf(value) === type;
const isSimpleType = type => value => typeof value === type;
const eq = t => a => t === a;
const is = (value, constructor) => isObject(value) && hasProto(value, constructor, (o, proto) => getPrototypeOf(o) === proto);
const isString = isType('string');
const isObject = isType('object');
const isPlainObject = value => is(value, Object);
const isArray = isType('array');
const isNull = eq(null);
const isBoolean = isSimpleType('boolean');
const isNullable = a => a === null || a === undefined;
const isNonNullable = a => !isNullable(a);
const isFunction = isSimpleType('function');
const isNumber = isSimpleType('number');
const isImage = elm => elm.nodeName === 'IMG';

const rawSet = (dom, key, value) => {
	if (isString(value) || isBoolean(value) || isNumber(value)) {
	  dom.setAttribute(key, value + '');
	} else {
	  console.error('Invalid call to Attribute.set. Key ', key, ':: Value ', value, ':: Element ', dom);
	  throw new Error('Attribute value was not simple');
	}
};

const getAttrib = (image, name) => {
	if (image.hasAttribute(name)) {
	return image.getAttribute(name);
	} else {
	return '';
	}
};