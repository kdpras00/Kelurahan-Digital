/**
 * Focus management helper for accessibility
 */

/**
 * Focus the first focusable element within a container
 * @param {HTMLElement} container - The container element to search within
 */
export function focusFirstElement(container) {
  const focusableElements = getFocusableElements(container)
  if (focusableElements.length > 0) {
    focusableElements[0].focus()
  }
}

/**
 * Get all focusable elements within a container
 * @param {HTMLElement} container - The container element to search within
 * @returns {HTMLElement[]} Array of focusable elements
 */
export function getFocusableElements(container) {
  const focusableSelectors = [
    'a[href]',
    'button:not([disabled])',
    'input:not([disabled])',
    'select:not([disabled])',
    'textarea:not([disabled])',
    '[tabindex]:not([tabindex="-1"])',
    '[contenteditable]:not([contenteditable="false"])'
  ]
  
  return Array.from(container.querySelectorAll(focusableSelectors.join(', ')))
    .filter(el => {
      // Check if element is visible
      const style = window.getComputedStyle(el)
      return style.display !== 'none' && 
             style.visibility !== 'hidden' && 
             style.opacity !== '0' &&
             el.offsetWidth > 0 && 
             el.offsetHeight > 0
    })
}

/**
 * Trap focus within a container (for modals, dropdowns, etc.)
 * @param {HTMLElement} container - The container to trap focus within
 * @param {Event} event - The keyboard event
 */
export function trapFocus(container, event) {
  if (event.key !== 'Tab') return
  
  const focusableElements = getFocusableElements(container)
  if (focusableElements.length === 0) return
  
  const firstElement = focusableElements[0]
  const lastElement = focusableElements[focusableElements.length - 1]
  
  if (event.shiftKey) {
    // Shift + Tab
    if (document.activeElement === firstElement) {
      event.preventDefault()
      lastElement.focus()
    }
  } else {
    // Tab
    if (document.activeElement === lastElement) {
      event.preventDefault()
      firstElement.focus()
    }
  }
}

/**
 * Set focus to an element with accessibility considerations
 * @param {HTMLElement} element - The element to focus
 */
export function setFocus(element) {
  if (!element || typeof element.focus !== 'function') return
  
  // Ensure the element is focusable
  if (element.tabIndex < 0) {
    element.tabIndex = -1
  }
  
  element.focus()
  
  // Scroll element into view if needed
  element.scrollIntoView({ behavior: 'smooth', block: 'nearest' })
}