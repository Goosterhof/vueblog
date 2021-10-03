import api from "./api"

export default {
    createSession(){
        return api.get("sanctum/csrf-cookie")
    },
    login(params){
        return api.post("api/login", params)
    },
    logout(){
        return api.delete("api/logout")
    }
}