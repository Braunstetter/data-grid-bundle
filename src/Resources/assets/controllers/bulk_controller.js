import Controller from "stimulus-checkbox-select-all"


export default class extends Controller {
    connect() {

        console.log(this.hasCheckboxAllTarget)
        super.connect();
    }
}
