export default class baseNativeJsClass {
    constructor() {
        this.selector = null;
    }

    changeValueSelector(value) {
        document.querySelector(this.selector).innerText = value;
    }

    //.... other methods base (for all pages)
}
