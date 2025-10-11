import { mount } from '@vue/test-utils'
import StatCard from './StatCard.vue'

describe('StatCard', () => {
  it('renders properly with required props', () => {
    const wrapper = mount(StatCard, {
      props: {
        title: 'Test Title',
        value: '123',
        icon: '/test-icon.svg'
      }
    })

    expect(wrapper.text()).toContain('Test Title')
    expect(wrapper.text()).toContain('123')
  })

  it('displays trend information when provided', () => {
    const wrapper = mount(StatCard, {
      props: {
        title: 'Test Title',
        value: '123',
        icon: '/test-icon.svg',
        trend: 'up',
        trendText: '+10% from last month'
      }
    })

    expect(wrapper.text()).toContain('+10% from last month')
  })

  it('applies correct CSS classes based on trend', async () => {
    const wrapper = mount(StatCard, {
      props: {
        title: 'Test Title',
        value: '123',
        icon: '/test-icon.svg',
        trend: 'up',
        trendText: '+10% from last month'
      }
    })

    // Check if trend up icon is rendered
    const trendUpIcon = wrapper.find('img[src="/assets/images/icons/trend-up-dark-green-fill.svg"]')
    expect(trendUpIcon.exists()).toBe(true)

    // Check if text has correct color class
    const trendText = wrapper.find('.text-desa-dark-green')
    expect(trendText.exists()).toBe(true)
  })
})