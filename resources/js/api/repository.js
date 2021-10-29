import api from "./api"

// TODO :: nice use of repository, but why only for this?
// You could create multiple repositories which will facilitate the communication with the server
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
