<!-- Modal de recherche -->
<div id="searchModal" style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
  <div style="background:#fff;padding:32px 24px;border-radius:12px;max-width:500px;width:90%;position:relative;">
    <button id="closeSearchModalBtn" style="position:absolute;top:8px;right:8px;background:none;border:none;font-size:1.5em;cursor:pointer;">&times;</button>
    <input type="text" id="searchbar" placeholder="Rechercher un produit..." autocomplete="off" style="width:100%;padding:12px 8px;border:1px solid #ccc;border-radius:4px;">
    <div id="search-results" style="max-height:300px;overflow-y:auto;margin-top:8px;"></div>
  </div>
</div>
