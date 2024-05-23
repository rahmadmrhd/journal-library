import { Tabs } from 'flowbite';
import $ from 'jquery';

function findTab(listTabs) {
  const hashs = location.hash.split('#')
  hashs.shift();

  for (let index = 0; index < hashs.length; index++) {
    const hash = hashs[index];
    if (listTabs.some((tab) => tab.name === hash)) {
      return hash;
    }
  }
  return false;
}
function setHash(hashBefore, hash) {
  let hashs = window.location.hash.split('#');
  // hashs.shift();
  hashs = hashs.filter(hash => hash);
  const index = hashs.indexOf(hashBefore);

  if (index < 0) {
    hashs.push(hash);
  } else {
    hashs[hashs.indexOf(hashBefore)] = hash;
  }
  window.location.hash = hashs.join('#');
}

window.registerTabsPanel = (listTabs, tabsEl, withFragment) => {
  const tabElements = listTabs.map((tab) => {
    const contentEL = document.getElementById(tab.name + '-content');
    contentEL.classList.add('hidden')
    return {
      id: tab.name,
      triggerEl: document.getElementById(tab.name + '-tab'),
      targetEl: contentEL
    }
  })

  const locationTab = withFragment ? findTab(listTabs) : null;
  const options = {
    defaultTabId: locationTab ?? listTabs[0].name,
    activeClasses:
      'text-blue-600 border-b-2 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
    inactiveClasses:
      'text-gray-700 hover:text-gray-800 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: (tab) => {
      if (withFragment) {
        setHash(findTab(listTabs), tab._activeTab.id)
      }
    }
  };

  const tabs = new Tabs(tabsEl, tabElements, options);

  if (withFragment) {
    $(window).on('hashchange', () => {
      const tab = findTab(listTabs);
      if (tab) {
        tabs.show(tab)
      }
    });
  }
}