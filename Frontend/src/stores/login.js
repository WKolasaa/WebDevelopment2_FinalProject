import { defineStore } from 'pinia'
import axios from 'axios'

export const login = defineStore('store', {
    state: () => ({
        user: null, // Change to null to indicate no user initially
        token: ''
    }),
    getters: {
        isLoggedIn: (state) => !!state.user, // Check if user object exists
        getToken: (state) => state.token,
        getUserRole: (state) => {
            if (state.user) {
                return state.user.role;
            } else {
                return null;
            }
        }
    },
    actions: {
        login(username, password) { // TODO: add wrong password handling
            return new Promise((resolve, reject) => {
                axios
                    .post('http://localhost/users/login', {
                        username: username,
                        password: password
                    })
                    .then((response) => {
                        console.log(response.data);
                        this.token = response.data.jwt;
                        this.user = response.data.user;
                        localStorage.setItem('token', this.token);
                        localStorage.setItem('user', JSON.stringify(this.user)); // Store user as string
                        resolve();
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        logout() {
            this.user = null; // Set user to null
            this.token = '';
            // Clear token from storage
            localStorage.removeItem('token');
            localStorage.removeItem('user');
        },
    },
});

