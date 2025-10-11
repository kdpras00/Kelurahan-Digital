// file yang digunakan untuk konfigurasi axios

import axios from 'axios'
import Cookies from 'js-cookie'

const token = Cookies.get('token')

axios.defaults.baseURL = 'http://localhost:8000/api'
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers.common['Accept'] = 'application/json'
axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

axios.interceptors.request.use((config) => {
  const token = Cookies.get('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  // Set default content type to JSON for all requests
  if (!config.headers['Content-Type']) {
    config.headers['Content-Type'] = 'application/json'
  }
  return config
})

// Add response interceptor to handle 401 errors
// We'll just let the error propagate and handle it in the calling code
axios.interceptors.response.use(
  (response) => response,
  (error) => {
    return Promise.reject(error)
  }
)

export const axiosInstance = axios