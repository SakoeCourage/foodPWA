import dayjs from "dayjs"
import getmonth from "./Getmonth"

import relativeTime from 'dayjs/plugin/relativeTime';
dayjs.extend(relativeTime);

export function setImage(created_at, img) {
    let path =  import.meta.env.VITE_FOOD_THUNBNAILSPATH
    let year = dayjs(created_at).year()
    let month = getmonth(dayjs(created_at).month())
    return `${path}/${year}/${month}/${img}`
}

export function diffForHumans(date) {
    if (!date) {
        return null
    }
    return dayjs(date).fromNow();


}

export function setProfileImage(img) {
    let path = process.env.VUE_APP_PROFILE_IMAGE
    return `${path}/${img}`
}