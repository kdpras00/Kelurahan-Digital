# Dashboard Components

This directory contains reusable Vue components for the dashboard interface.

## Components

### StatCard.vue

A card component for displaying statistics with title, value, icon, and optional trend information.

**Props:**

-   `title` (String, required): The title of the statistic
-   `value` (String|Number, required): The value to display
-   `icon` (String, required): Path to the icon image
-   `trend` (String, optional): Trend direction ('up' or 'down')
-   `trendText` (String, optional): Text to display for the trend

**Example:**

```vue
<StatCard
    title="Total Users"
    :value="1234"
    icon="/assets/icons/users.svg"
    trend="up"
    trend-text="+12% from last month"
/>
```

### SocialAssistanceItem.vue

A component for displaying social assistance items with status indicators.

**Props:**

-   `icon` (String, required): Path to the icon image
-   `title` (String, required): Title of the assistance item
-   `description` (String, required): Description of the assistance item
-   `status` (String, required): Status of the item ('Menunggu', 'Diterima', 'Ditolak')
-   `amount` (String, optional): Amount of assistance (if applicable)

**Example:**

```vue
<SocialAssistanceItem
    icon="/assets/icons/money.svg"
    title="Rp500.000"
    description="Diberikan oleh RW 01"
    status="Diterima"
/>
```

### ApplicantCard.vue

A component for displaying job applicant information.

**Props:**

-   `companyLogo` (String, required): Path to the company logo
-   `applicantPhoto` (String, required): Path to the applicant's photo
-   `applicantName` (String, required): Name of the applicant
-   `position` (String, required): Position applied for
-   `status` (String, required): Status of the application ('Menunggu', 'Diterima', 'Ditolak')

**Example:**

```vue
<ApplicantCard
    companyLogo="/assets/logos/company.jpg"
    applicantPhoto="/assets/photos/applicant.jpg"
    applicantName="John Doe"
    position="Software Engineer"
    status="Diterima"
/>
```

### LoadingSpinner.vue

A simple loading spinner component.

**Props:**

-   `size` (String, optional): Size of the spinner ('sm', 'md', 'lg')

**Example:**

```vue
<LoadingSpinner size="lg" />
```

### ErrorDisplay.vue

A component for displaying error messages with optional retry functionality.

**Props:**

-   `message` (String, required): Error message to display
-   `onRetry` (Function, optional): Function to call when retry button is clicked

**Example:**

```vue
<ErrorDisplay message="Failed to load data" :on-retry="retryFunction" />
```

### PopulationChart.vue

A component for displaying population statistics in a chart format.

**Props:**

-   `totalPopulation` (Number, optional): Total population count
-   `demographics` (Array, optional): Array of demographic data

**Example:**

```vue
<PopulationChart :total-population="243000" :demographics="demographicData" />
```

## Composables

### useDashboard.js

A composable for managing dashboard data and state.

**Usage:**

```javascript
import { useDashboard } from "@/composables/useDashboard";

const {
    statistics,
    loading,
    error,
    hasError,
    isLoading,
    fetchDashboardData,
    refreshData,
} = useDashboard();
```

## Accessibility Features

All components include proper accessibility features:

-   Semantic HTML structure
-   Proper ARIA attributes
-   Keyboard navigation support
-   Screen reader friendly labels
-   Focus management

## Styling

Components use the existing Tailwind CSS classes and custom CSS variables defined in the project.
