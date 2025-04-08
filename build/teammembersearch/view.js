/******/ (() => { // webpackBootstrap
/*!**************************************!*\
  !*** ./src/teammembersearch/view.js ***!
  \**************************************/
const allSearchFields = document.querySelectorAll('.members-search-input');
allSearchFields.forEach(element => {
  const searchInput = element.querySelector('input');
  let debounceTimer;
  searchInput.addEventListener('input', function (e) {
    const value = e.target.value.trim();
    clearTimeout(debounceTimer);
    if (value.length < 3) {
      element.querySelector('.results').innerHTML = '';
      return;
    }
    debounceTimer = setTimeout(() => {
      performSearch(value);
    }, 300);
    async function performSearch(query) {
      try {
        const encodedQuery = encodeURIComponent(query);
        const apiUrl = `/wp-json/wp/v2/team_member?search=${encodedQuery}`;
        const response = await fetch(apiUrl);
        const results = await response.json();
        if (results.length) {
          const html = await showResults(results);
          element.querySelector('.results').innerHTML = html;
        } else {
          element.querySelector('.results').innerHTML = '<div class="error">No team members found.</div>';
        }
      } catch (error) {
        console.error('Error fetching team members:', error);
        element.querySelector('.results').innerHTML = '<div class="error">Something went wrong.</div>';
      }
    }
  });
});
async function showResults(results) {
  const items = await Promise.all(results.map(async item => {
    const memberImage = await getImageUrl(item.featured_media);
    return `
				<div class="item">
					<a href="${item.link}">
						<img width="48" src="${memberImage}" alt="${item.title.rendered}" />
						<span>${item.title.rendered}</span>
					</a>
				</div>
			`;
  }));
  return items.join('');
}
async function getImageUrl(mediaId) {
  if (!mediaId) return '';
  try {
    const res = await fetch(`/wp-json/wp/v2/media/${mediaId}`);
    const data = await res.json();
    return data.source_url || '';
  } catch (error) {
    console.error('Failed to fetch image:', error);
    return '';
  }
}
/******/ })()
;
//# sourceMappingURL=view.js.map