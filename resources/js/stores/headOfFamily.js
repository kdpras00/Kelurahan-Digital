import { defineStore } from 'pinia'
import { axiosInstance } from '@/plugins/axios'
import { handleError } from '@/helpers/errorHelper'

export const useHeadOfFamilyStore = defineStore('headOfFamily', {
  state: () => ({
    headOfFamilies: [],
    pagination: {
      current_page: 1,
      last_page: 1,
      per_page: 5,
      total: 0,
    },
    loading: false,
    error: null,
    success: null,
  }),

  getters: {
    isLoading: (state) => state.loading,
    hasError: (state) => state.error !== null,
    errorMessage: (state) => state.error,
  },

  actions: {
    async fetchHeadOfFamilies(params = {}) {
      // Don't fetch if already loading
      if (this.loading) return
      
      this.loading = true
      this.error = null

      try {
        const response = await axiosInstance.get('/head-of-family/all/paginated', {
          params: {
            row_per_page: params.perPage || this.pagination.per_page,
            search: params.search || null,
            page: params.page || this.pagination.current_page,
          }
        })
    
        console.log('API Response:', response.data); // Add this for debugging
    
        if (response.data && response.data.data) {
          // Extract data and pagination info
          const data = response.data.data
          console.log('Data from API:', data); // Add this for debugging
          
          this.headOfFamilies = data.data.map(item => ({
            id: item.id,
            userId: item.user?.id || '',
            name: item.user?.name || '',
            photo: item.profile_picture ? 
              (item.profile_picture.startsWith('http') ? item.profile_picture : `/storage/${item.profile_picture}`) : 
              '/images/photos/kk-photo-1.png',
            occupation: item.occupation || '',
            nik: item.identity_number || '',
            familyMembers: item.family_members ? item.family_members.length : 0
          }))
          
          console.log('Processed headOfFamilies:', this.headOfFamilies); // Add this for debugging
          
          // Update pagination
          this.pagination = {
            current_page: data.current_page,
            last_page: data.last_page,
            per_page: data.per_page,
            total: data.total,
          }
          
          this.success = 'Data loaded successfully'
        } else {
          throw new Error('Invalid response format')
        }
      } catch (error) {
        this.error = handleError(error)
        console.error('Head of families fetch error:', error)
      } finally {
        this.loading = false
      }
    },
    
    async deleteHeadOfFamily(id) {
      this.loading = true
      this.error = null
      
      try {
        const response = await axiosInstance.delete(`/head-of-family/${id}`)
        
        if (response.data.success) {
          // Remove from local state
          this.headOfFamilies = this.headOfFamilies.filter(hof => hof.id !== id)
          this.success = 'Head of family deleted successfully'
          return true
        } else {
          throw new Error(response.data.message || 'Failed to delete head of family')
        }
      } catch (error) {
        this.error = handleError(error)
        console.error('Head of family delete error:', error)
        return false
      } finally {
        this.loading = false
      }
    },
    
    clearError() {
      this.error = null
    },
    
    updatePagination(newPagination) {
      this.pagination = { ...this.pagination, ...newPagination }
    }
  },
})