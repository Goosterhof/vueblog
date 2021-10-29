import axios from "axios"

// TODO :: const, you don't want to be able to change this instance anywhere
let instance = axios.create({
    withCredentials: true
})

instance.interceptors.request.use(request => {
    request.headers.common["Accept"] = 'application/json'
    request.headers.common["Content-Type"] = 'application/json'
    return request
})

instance.interceptors.response.use(
    // TODO :: can be even shorter: response => response
    response => {return response},
    error => {
        if(error.response.status === 401){
            sessionStorage.removeItem("user")
            window.location.reload
        }
        return Promise.reject(error)
    }
)

export default instance
