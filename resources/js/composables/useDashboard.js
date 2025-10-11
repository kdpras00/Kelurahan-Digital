import { ref, computed } from 'vue'
import { useDashboardStore } from '@/stores/dashboard'

/**
 * Composable for dashboard data management
 */
export function useDashboard() {
  const dashboardStore = useDashboardStore()
  
  // Reactive references for dashboard data
  const dashboardData = computed(() => dashboardStore.dashboardData)
  const loading = computed(() => dashboardStore.loading)
  const error = computed(() => dashboardStore.error)
  
  // Computed properties for specific data points
  const statistics = computed(() => ({
    residents: dashboardStore.residents,
    headOfFamilies: dashboardStore.headOfFamilies,
    socialAssistances: dashboardStore.socialAssistances,
    events: dashboardStore.events,
    jobApplicants: dashboardStore.jobApplicants
  }))
  
  // Methods
  const fetchDashboardData = async () => {
    return await dashboardStore.fetchDashboardData()
  }
  
  const refreshData = async () => {
    dashboardStore.clearError()
    return await fetchDashboardData()
  }
  
  const clearError = () => {
    dashboardStore.clearError()
  }
  
  // Loading and error states
  const isLoading = computed(() => loading.value)
  const hasError = computed(() => error.value !== null)
  const errorMessage = computed(() => error.value)
  
  return {
    // Data
    dashboardData,
    statistics,
    loading: isLoading,
    error: errorMessage,
    
    // States
    isLoading: isLoading,
    hasError: hasError,
    
    // Methods
    fetchDashboardData,
    refreshData,
    clearError
  }
}