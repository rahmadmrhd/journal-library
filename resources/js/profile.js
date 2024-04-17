import { Tabs } from 'flowbite';
import $ from 'jquery';

const tabsEl = document.getElementById('tab')

const tabElements = [
  {
    id: 'profile',
    triggerEl: document.getElementById('profile-tab'),
    targetEl: document.getElementById('profile-content')
  },
  {
    id: 'account',
    triggerEl: document.getElementById('account-tab'),
    targetEl: document.getElementById('account-content')
  }
]

const locationTab = $(location).attr('hash').replace('#', '');
const options = {
  defaultTabId: locationTab ?? 'profile',
  activeClasses:
    'text-blue-600 border-b-2 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
  inactiveClasses:
    'text-gray-700 hover:text-gray-800 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
  onShow: (tab) => {
    window.location.hash = tab._activeTab.id
  }
};

const tabs = new Tabs(tabsEl, tabElements, options);

$(window).on('hashchange', () => {
  tabs.show(location.hash.replace('#', ''))
})