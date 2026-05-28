(function () {
  var STORAGE_KEY = "wisataku_favorites";

  function readFavorites() {
    try {
      var raw = window.localStorage.getItem(STORAGE_KEY);
      var data = raw ? JSON.parse(raw) : [];
      return Array.isArray(data) ? data : [];
    } catch (error) {
      return [];
    }
  }

  function writeFavorites(favorites) {
    window.localStorage.setItem(STORAGE_KEY, JSON.stringify(favorites));
    window.dispatchEvent(
      new CustomEvent("favorites:updated", {
        detail: favorites,
      })
    );
  }

  function upsertFavorite(item) {
    var favorites = readFavorites();
    var index = favorites.findIndex(function (favorite) {
      return favorite.id === item.id;
    });

    if (index >= 0) {
      favorites.splice(index, 1);
      writeFavorites(favorites);
      return false;
    }

    favorites.push(item);
    writeFavorites(favorites);
    return true;
  }

  function removeFavorite(id) {
    var favorites = readFavorites().filter(function (favorite) {
      return favorite.id !== id;
    });
    writeFavorites(favorites);
  }

  function isFavorite(id) {
    return readFavorites().some(function (favorite) {
      return favorite.id === id;
    });
  }

  function updateButtonState(button, active) {
    var icon = button.querySelector("img");
    var iconDefault = button.dataset.iconDefault;
    var iconActive = button.dataset.iconActive;

    button.classList.toggle("is-active", active);
    button.setAttribute("aria-pressed", active ? "true" : "false");

    if (icon && iconDefault && iconActive) {
      icon.src = active ? iconActive : iconDefault;
    }
  }

  function buttonPayload(button) {
    return {
      id: button.dataset.id,
      name: button.dataset.name,
      location: button.dataset.location,
      price: Number(button.dataset.price || 0),
      rating: Number(button.dataset.rating || 0),
      image: button.dataset.image,
      href: button.dataset.href,
      category: button.dataset.category || "",
    };
  }

  function syncButtons() {
    document.querySelectorAll("[data-favorite-button]").forEach(function (button) {
      updateButtonState(button, isFavorite(button.dataset.id));
    });
  }

  function bindButtons(scope) {
    var root = scope || document;
    root.querySelectorAll("[data-favorite-button]").forEach(function (button) {
      if (button.dataset.favoriteBound === "true") {
        return;
      }

      button.dataset.favoriteBound = "true";
      updateButtonState(button, isFavorite(button.dataset.id));

      button.addEventListener("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        upsertFavorite(buttonPayload(button));
        syncButtons();
      });
    });
  }

  function formatPrice(value) {
    return "Rp " + Number(value || 0).toLocaleString("id-ID");
  }

  window.favoriteStore = {
    bindButtons: bindButtons,
    formatPrice: formatPrice,
    getAll: readFavorites,
    isFavorite: isFavorite,
    remove: removeFavorite,
    syncButtons: syncButtons,
  };

  document.addEventListener("DOMContentLoaded", function () {
    bindButtons(document);
  });

  window.addEventListener("favorites:updated", function () {
    syncButtons();
  });

  window.addEventListener("storage", function (event) {
    if (event.key === STORAGE_KEY) {
      syncButtons();
    }
  });
})();
