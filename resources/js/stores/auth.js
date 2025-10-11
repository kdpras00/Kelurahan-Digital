import { axiosInstance } from '@/plugins/axios'
import { router } from '@inertiajs/vue3'

import { defineStore } from 'pinia'

import Cookies from 'js-cookie'
import { handleError } from '@/helpers/errorHelper'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    loading: false,
    error: null,
    success: null,
  }),
  getters: {
    token: (state) => Cookies.get('token'),
    isAuthenticated: (state) => !!state.user,
  },
  actions: {
    async login(credentials) {
      this.loading = true
      this.error = null
      try {
        // Make sure we're sending JSON data
        const response = await axiosInstance.post('/login', credentials, {
          headers: {
            'Content-Type': 'application/json',
          }
        })
        const token = response.data.token
        Cookies.set('token', token)
        this.success = 'Login berhasil'
        // Fetch user data after successful login
        await this.checkAuth()
        router.visit(route('dashboard'))
      } catch (error) {
        this.error = handleError(error)
      } finally {
        this.loading = false
      }
    },
    async logout() {
      this.loading = true

      try {
        await axiosInstance.post('/logout')
      } catch (error) {
        // Ignore errors during logout
        console.error('Logout error:', error)
      } finally {
        Cookies.remove('token')
        this.user = null
        this.error = null
        this.success = 'Logout berhasil'
        this.loading = false
        router.visit(route('login'))
      }
    },
    async checkAuth() {
      // Don't redirect to login on auth check failure, just update the store
      this.loading = true
      try {
        const response = await axiosInstance.get('/me')
        this.user = response.data.data
        return this.user
      } catch (error) {
        // On error, clear user data but don't redirect
        this.user = null
        this.error = handleError(error)
      } finally {
        this.loading = false
      }
    },
    // New method to protect routes
    async requireAuth() {
      // If we haven't checked auth yet, do so now
      if (this.user === null && Cookies.get('token')) {
        await this.checkAuth()
      }
      
      // If user is not authenticated, redirect to login
      if (!this.user) {
        router.visit(route('login'))
        return false
      }
      
      return true
    }
  },
})