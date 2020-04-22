export class CacheData {

    constructor() {
        this.data = new Array();
        this.id = 0;
    }

    contains(id){
        return this.data[id] != undefined
    }

    add(data){
        this.id = data.id;
        this.data[data.id] = data.result;
    }

    addId(id){
        this.id = id;
    }

    getLast(){
        return this.data[this.id];
    }

    // delete(callback) {
    //     callback(arguments[0]);
    // }
}