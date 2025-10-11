import { useHeadOfFamilyStore } from '../stores/headOfFamily'

// Mock the axios instance
jest.mock('../plugins/axios', () => ({
  axiosInstance: {
    get: jest.fn(),
    delete: jest.fn()
  }
}))

// Mock the error handler
jest.mock('../helpers/errorHelper', () => ({
  handleError: jest.fn((error) => error.message || 'An error occurred')
}))

describe('HeadOfFamily Store', () => {
  let store

  beforeEach(() => {
    store = useHeadOfFamilyStore()
  })

  afterEach(() => {
    store.$reset()
  })

  it('should fetch head of families data', async () => {
    // Mock API response
    const mockResponse = {
      data: {
        data: {
          data: [
            {
              id: 1,
              user: { name: 'Andi Alif Baro' },
              profile_picture: 'path/to/photo.jpg',
              occupation: 'Mekanik Kendaraan',
              identity_number: '2005100592201005',
              family_members: [{}, {}, {}] // 3 family members
            }
          ],
          current_page: 1,
          last_page: 1,
          per_page: 5,
          total: 1
        }
      }
    }

    // Mock the axios get method
    const { axiosInstance } = require('../plugins/axios')
    axiosInstance.get.mockResolvedValue(mockResponse)

    // Fetch data
    await store.fetchHeadOfFamilies()

    // Assertions
    expect(store.headOfFamilies).toHaveLength(1)
    expect(store.headOfFamilies[0]).toEqual({
      id: 1,
      name: 'Andi Alif Baro',
      photo: '/storage/path/to/photo.jpg',
      occupation: 'Mekanik Kendaraan',
      nik: '2005100592201005',
      familyMembers: 3
    })
    
    expect(store.pagination).toEqual({
      current_page: 1,
      last_page: 1,
      per_page: 5,
      total: 1
    })
  })

  it('should handle fetch error', async () => {
    // Mock API error
    const mockError = new Error('Network error')
    const { axiosInstance } = require('../plugins/axios')
    axiosInstance.get.mockRejectedValue(mockError)

    // Fetch data
    await store.fetchHeadOfFamilies()

    // Assertions
    expect(store.error).toBe('Network error')
    expect(store.headOfFamilies).toHaveLength(0)
  })
})