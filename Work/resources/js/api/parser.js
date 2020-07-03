import axios from 'axios'

export default {
    parse(){
        return axios.post("/api/functions/swap_schedule_parse").then(res=>{
            return res.data.result;
        });
    },
    save(data){
        return axios.post("/api/save/swap_schedule",data).then(res=>{
            return res.data.result;
        });
    }
}