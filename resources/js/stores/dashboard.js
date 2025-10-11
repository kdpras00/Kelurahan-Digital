import { defineStore } from 'pinia'
import { axiosInstance } from '@/plugins/axios'
import { handleError } from '@/helpers/errorHelper'

export const useDashboardStore = defineStore('dashboard', {
  state: () => ({
    dashboardData: {},
    loading: false,
    error: null,
    success: null,
  }),

  getters: {
    isLoading: (state) => state.loading,
    hasError: (state) => state.error !== null,
    errorMessage: (state) => state.error,
    residents: (state) => state.dashboardData.residents || 0,
    headOfFamilies: (state) => state.dashboardData.head_of_families || 0,
    socialAssistances: (state) => state.dashboardData.social_assistances || 0,
    events: (state) => state.dashboardData.events || 0,
    jobApplicants: (state) => state.dashboardData.job_applicants || 0,
  },

  actions: {
    async fetchDashboardData() {
      // Don't fetch if already loading
      if (this.loading) return
      
      this.loading = true
      this.error = null

      try {
        const response = await axiosInstance.get(`/dashboard/get-dashboard-data`)
        
        if (response.data && response.data.data) {
          this.dashboardData = response.data.data
          this.success = 'Data loaded successfully'
        } else {
          throw new Error('Invalid response format')
        }
      } catch (error) {
        this.error = handleError(error)
        console.error('Dashboard data fetch error:', error)
      } finally {
        this.loading = false
      }
    },
    
    clearError() {
      this.error = null
    },
    
    refreshData() {
      this.clearError()
      return this.fetchDashboardData()
    }
  },
})
