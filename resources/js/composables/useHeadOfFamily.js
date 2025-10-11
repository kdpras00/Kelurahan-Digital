import { ref, computed } from 'vue'
import { useHeadOfFamilyStore } from '@/stores/headOfFamily'

/**
 * Composable for head of family data management
 */
export function useHeadOfFamily() {
  const headOfFamilyStore = useHeadOfFamilyStore()
  
  // Reactive references for head of family data
  const headOfFamilies = computed(() => headOfFamilyStore.headOfFamilies)
  const loading = computed(() => headOfFamilyStore.loading)
  const error = computed(() => headOfFamilyStore.error)
  const pagination = computed(() => headOfFamilyStore.pagination)
  
  // Methods
  const fetchHeadOfFamilies = async (params = {}) => {
    return await headOfFamilyStore.fetchHeadOfFamilies(params)
  }
  
  const deleteHeadOfFamily = async (id) => {
    return await headOfFamilyStore.deleteHeadOfFamily(id)
  }
  
  const refreshData = async (params = {}) => {
    headOfFamilyStore.clearError()
    return await fetchHeadOfFamilies(params)
  }
  
  const clearError = () => {
    headOfFamilyStore.clearError()
  }
  
  // Loading and error states
  const isLoading = computed(() => loading.value)
  const hasError = computed(() => error.value !== null)
  const errorMessage = computed(() => error.value)
  
  return {
    // Data
    headOfFamilies,
    pagination,
    loading: isLoading,
    error: errorMessage,
    
    // States
    isLoading: isLoading,
    hasError: hasError,
    
    // Methods
    fetchHeadOfFamilies,
    deleteHeadOfFamily,
    refreshData,
    clearError
  }
}