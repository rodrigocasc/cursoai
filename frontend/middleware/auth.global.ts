export default defineNuxtRouteMiddleware(async (to, from) => {
    if(to.path == "/register") {
        return;
    }
    
    checkSession();
    if(to.path != "/"  && useUserSession.value == null) {
        return navigateTo("/");
    }
})

export const checkSession = async () => {
    const cookie = useCookie('cursoai_session');

    if(cookie.value != null) {
        const decode = atob(cookie.value)
        return useUserSession.value = JSON.parse(decode)
    }

    return useUserSession.value = null
}