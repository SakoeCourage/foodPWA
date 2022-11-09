import axios from "axios";
import cookie from 'js-cookie'

let token = cookie.get('XSRF-TOKEN')
let Api = axios.create({
    baseURL: `http://127.0.0.1:8000/api`,
    'Authorization': `${token}`,
    withCredentials: true
})

export default Api;