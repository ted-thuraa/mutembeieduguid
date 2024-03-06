import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            id: "",
            firstname: "",
            lastname: "",
            email: "",
            image: "",
            institution: "",
            course: "",
            year: "",
            isAdmin: sessionStorage.getItem("isAdmin"),
            token: sessionStorage.getItem("TOKEN"),
            loading: true,
            //token: 124,
        },
        clientResources: {
            loading: false,
            all: [],
            books: [],
            articles: [],
            videos: [],
        },
        reviews: {
            loading: false,
            data: [],
        },

        //Admin
        users: {
            loading: false,
            data: [],
        },
        resources: {
            loading: false,
            data: [],
        },
        analytics: {
            loading: false,
            data: [],
        },

        //loading and toasts
        notification: {
            show: false,
            type: null,
            message: null,
        },
    },
    getters: {},
    actions: {
        //auth
        async login({ commit }, user) {
            await axiosClient.post("/login", user).then(({ data }) => {
                commit("setUserLoading", true);
                commit("setUser", data.user);
                commit("setIsAdmin", data.user.isAdmin);
                commit("setToken", data.token);
                this.dispatch("getUserTheme");
                return data;
            });
        },

        async verifyemailtoken({ commit }, code) {
            commit("setUserLoading", true);
            return axiosClient
                .post("/verify-email-token", { code: code })
                .then(({ data }) => {
                    commit("setUser", data.user);
                    commit("setIsAdmin", data.user.isAdmin);
                    commit("setToken", data.token);
                    console.log(data.user);
                    this.dispatch("getUserTheme");
                    return data;
                })
                .catch((error) => {
                    console.log(error);
                    //throw error;
                    return error;
                });
        },
        async register({ commit }, user) {
            await axiosClient.post("/register", user).then(({ data }) => {
                commit("setUserLoading", true);
                commit("setUser", data.user);
                commit("setIsAdmin", data.user.isAdmin);
                commit("setToken", data.token);

                return data;
            });
        },
        async logout({ commit }) {
            return axiosClient.post("/logout").then((response) => {
                commit("setToken", null);
                commit("setIsAdmin", null);
                commit("resetState");
                return response;
            });
        },

        async getUser({ commit }) {
            return axiosClient.get("/user").then(({ data }) => {
                commit("setUserLoading", true);
                commit("setUser", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                console.log(data.data);

                return data;
            });
        },
        async saveDetails({ commit }, details) {
            await axiosClient.post("/userdetails", details).then(({ data }) => {
                //commit("setUserLoading", true);
                console.log(data);

                return data;
            });
        },
        async getClientResources({ commit }) {
            await axiosClient.get("/getresource").then(({ data }) => {
                //commit("setUserLoading", true);
                console.log(data);
                commit("setClientResources", data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                //console.log(data);
                return data;
            });
        },
        async submitReview({ commit }, reviewData) {
            await axiosClient
                .post("/newreview", reviewData)
                .then(({ data }) => {
                    //commit("setUserLoading", true);
                    console.log(data);
                    //commit("setClientResources", data);
                    //commit("setIsAdmin", data.user.isAdmin);
                    //commit("setToken", data.token);
                    //console.log(data);
                    return data;
                });
        },
        async getReviews({ commit }, id) {
            await axiosClient.get(`/getreview/${id}`).then(({ data }) => {
                //commit("setUserLoading", true);
                console.log(data);
                commit("setReviews", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                //console.log(data);
                return data;
            });
        },

        //Admin
        async getUsers({ commit }) {
            return axiosClient.get("/admin/users").then(({ data }) => {
                commit("setUserLoading", true);
                commit("setUsers", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                console.log(data.data);

                return data;
            });
        },
        async getAnalytics({ commit }) {
            return axiosClient.get("/admin/analytics").then(({ data }) => {
                //commit("setUserLoading", true);
                commit("setAnalytics", data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                console.log(data.data);

                return data;
            });
        },
        async getResources({ commit }) {
            await axiosClient.get("/admin/getresource").then(({ data }) => {
                //commit("setUserLoading", true);
                console.log(data);
                commit("setResources", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                //console.log(data);
                return data;
            });
        },
        async createNewResource({ commit }, resourceDetails) {
            await axiosClient
                .post("/admin/newresource", resourceDetails)
                .then(({ data }) => {
                    //commit("setUserLoading", true);
                    console.log(data);
                    commit("setResources", data.data);
                    //commit("setIsAdmin", data.user.isAdmin);
                    //commit("setToken", data.token);
                    //console.log(data);
                    return data;
                });
        },
        async updateResource({ commit }, { resourceDetails, id }) {
            await axiosClient
                .post(`/admin/updateresource/${id}`, resourceDetails)
                .then(({ data }) => {
                    //commit("setUserLoading", true);
                    console.log(data);
                    commit("setResources", data.data);

                    return data;
                });
        },
        async deleteResource({ dispatch }, id) {
            await axiosClient
                .delete(`/admin/resource/${id}`)
                .then(({ data }) => {
                    dispatch("getResources");
                    return;
                });
        },
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
            state.user.isAdmin = false;
            //sessionStorage.setItem("isAdmin", false);
            //sessionStorage.setItem("TOKEN", null);
        },
        setUserLoading: (state, status) => {
            state.user.loading = status;
        },
        setUser: (state, user) => {
            console.log(user);
            state.user.id = user.id;
            //state.user.uuid = user.id;
            state.user.email = user.email;
            state.user.firstname = user.firstname;
            state.user.lastname = user.lastname;
            state.user.course = user.course;
            state.user.institution = user.institution;
            state.user.year = user.study_year;
            state.user.loading = false;
            state.user.isAdmin = user.isAdmin === 1 ? true : false;
            console.log(user.isAdmin);
            if (user.isAdmin) {
                sessionStorage.setItem("isAdmin", true);
            } else {
                sessionStorage.removeItem("isAdmin");
            }
        },
        setIsAdmin: (state, isAdmin) => {
            console.log(isAdmin);
            state.user.isAdmin = isAdmin === 1 ? true : false;
            if (isAdmin) {
                sessionStorage.setItem("isAdmin", isAdmin === 1 ? true : false);
            } else {
                sessionStorage.removeItem("isAdmin");
            }
        },
        setToken: (state, token) => {
            state.user.token = token;
            if (token) {
                sessionStorage.setItem("TOKEN", token);
            } else {
                sessionStorage.removeItem("TOKEN");
            }
        },

        notify: (state, { message, type }) => {
            state.notification.show = true;
            state.notification.type = type;
            state.notification.message = message;
            setTimeout(() => {
                state.notification.show = false;
            }, 3000);
        },

        setClientResources: (state, data) => {
            console.log(data);
            state.clientResources.all = data.allresources;
            state.clientResources.books = data.books;
            state.clientResources.articles = data.articles;
            state.clientResources.videos = data.videos;
        },

        setReviews: (state, data) => {
            console.log(data);
            state.reviews.data = data;
        },

        resetState: (state) => {
            state.user.id = "";
            state.user.name = "";
            state.user.email = "";
            //state.user.image = "";
        },

        // admin mutations
        setResources: (state, data) => {
            console.log(data);
            state.resources.data = data;
        },
        setAnalytics: (state, data) => {
            console.log(data);
            state.analytics.data = data;
        },
        setUsers: (state, data) => {
            console.log(data);
            state.users.data = data;
        },
    },
    persist: true,
    modules: {},
});

export default store;
