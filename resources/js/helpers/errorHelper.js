export function handleError(error) {
  if (error.response && error.response.status === 422) {
    return error.response.data.errors || 'Validation error occurred'
  } else if (error.response && error.response.status === 401) {
    return error.response.data.message || 'Unauthorized access'
  } else if (error.response && error.response.status === 400) {
    return error.response.data.message || 'Bad request'
  } else if (error.response && error.response.status === 500) {
    return error.response.data.message || 'Internal server error'
  } else if (error.response) {
    // Other HTTP errors
    return error.response.data.message || `HTTP error: ${error.response.status}`
  } else if (error.request) {
    // Network error
    return 'Network error. Please check your connection and try again.'
  } else {
    // Other errors
    return error.message || 'An unexpected error occurred. Please try again.'
  }
}
