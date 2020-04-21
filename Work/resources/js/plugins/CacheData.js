export default class CacheData{

    contructor(update){
        this.update = update;
        this.data = new Array();
    }

    async get(id)
    {
        if(this.data.includesById(id)){
            return this.data.findById(id).data;
        }
        else{
            let data = await this.update();
            this.data.push({id:id,data:data})
            return data;
        }
    }

    delete(callback){
        callback(arguments[0]);
    }
}

