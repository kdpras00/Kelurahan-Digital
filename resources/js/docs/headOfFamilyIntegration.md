# Head of Family Integration with Database

This document explains how the Head of Family page is integrated with the database to fetch real data instead of using static mock data.

## Overview

The Head of Family page now fetches data from the Laravel backend API instead of using hardcoded mock data. This implementation follows the same pattern used in the Dashboard page.

## Implementation Details

### 1. Store Layer (Pinia)

The `useHeadOfFamilyStore` is responsible for:

-   Managing the state of head of families data
-   Handling API calls to fetch and delete head of families
-   Managing pagination information
-   Handling loading and error states

Key methods:

-   `fetchHeadOfFamilies(params)`: Fetches paginated head of families data from the API
-   `deleteHeadOfFamily(id)`: Deletes a head of family record
-   `clearError()`: Clears any error state

### 2. Composable Layer

The `useHeadOfFamily` composable provides a clean interface for components to interact with the store:

-   Reactive data properties (headOfFamilies, pagination, loading, error)
-   Methods to fetch, delete, and refresh data
-   Computed properties for state management

### 3. Component Integration (Index.vue)

The HeadOfFamily Index page now:

-   Uses the `useHeadOfFamily` composable to access data and methods
-   Fetches real data when the component is mounted
-   Implements search and pagination functionality that works with the API
-   Handles loading and error states properly
-   Provides real delete functionality that removes records from the database

## API Endpoints Used

1. `GET /api/head-of-family/all/paginated` - Fetch paginated head of families
2. `DELETE /api/head-of-family/{id}` - Delete a head of family record

## Data Transformation

The API returns data in a specific format through the `HeadOfFamilyResource`. The store transforms this data to match what the UI component expects:

API Response Structure:

```json
{
    "data": {
        "data": [
            {
                "id": 1,
                "user": {
                    "name": "Andi Alif Baro"
                },
                "profile_picture": "path/to/photo.jpg",
                "occupation": "Mekanik Kendaraan",
                "identity_number": "2005100592201005",
                "family_members": [
                    // Array of family members
                ]
            }
        ],
        "current_page": 1,
        "last_page": 1,
        "per_page": 5,
        "total": 1
    }
}
```

Transformed for UI:

```javascript
{
  id: 1,
  name: 'Andi Alif Baro',
  photo: '/storage/path/to/photo.jpg',
  occupation: 'Mekanik Kendaraan',
  nik: '2005100592201005',
  familyMembers: 0 // Length of family_members array
}
```

## Features Implemented

1. **Real Data Fetching**: Data is fetched from the database via API
2. **Search Functionality**: Search works with the backend API
3. **Pagination**: Full pagination support with page navigation
4. **Delete Functionality**: Records can be deleted from the database
5. **Loading States**: Proper loading indicators during API calls
6. **Error Handling**: Comprehensive error handling with user feedback
7. **Responsive Updates**: UI updates automatically when data changes

## Testing

Unit tests are included in `resources/js/tests/headOfFamily.test.js` to verify the store functionality.
