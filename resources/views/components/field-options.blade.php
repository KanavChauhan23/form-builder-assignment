<div class="fb-opt-header">
  <span class="fb-opt-badge" id="optFieldTypeBadge">Field</span>
  <button class="fb-opt-back" onclick="switchSubTab('add')" title="Back">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
  </button>
</div>
<div class="fb-opt-body">

  <div class="fb-opt-group">
    <label class="fb-opt-label" for="optLabel">Label <span class="fb-req-badge">required</span></label>
    <x-form-input id="optLabel" placeholder="Field label..." oninput="updateFieldFromOptions()" />
  </div>

  <div class="fb-opt-group" id="optPlaceholderRow">
    <label class="fb-opt-label" for="optPlaceholder">Placeholder</label>
    <x-form-input id="optPlaceholder" placeholder="Hint text..." oninput="updateFieldFromOptions()" />
  </div>

  <div class="fb-opt-group" id="optMinMaxRow" style="display:none;">
    <label class="fb-opt-label">Character Limits</label>
    <div class="fb-minmax-row">
      <div>
        <label class="fb-sub-label">Min</label>
        <x-form-input id="optMinChars" type="number" placeholder="0" oninput="updateFieldFromOptions()" />
      </div>
      <div>
        <label class="fb-sub-label">Max</label>
        <x-form-input id="optMaxChars" type="number" placeholder="∞" oninput="updateFieldFromOptions()" />
      </div>
    </div>
  </div>

  <div class="fb-opt-group" id="optOptionsRow" style="display:none;">
    <label class="fb-opt-label">Options</label>
    <div id="optionsList" class="fb-options-list"></div>
    <button type="button" class="fb-add-opt-btn" onclick="addOption()">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
      Add Option
    </button>
  </div>

  <div class="fb-opt-group" id="optDefaultRow" style="display:none;">
    <label class="fb-opt-label" for="optDefault">Default Value</label>
    <x-form-input id="optDefault" placeholder="Pre-filled value..." oninput="updateFieldFromOptions()" />
  </div>

  <div class="fb-opt-group">
    <label class="fb-opt-label">Validation</label>
    <label class="fb-toggle-wrap" for="optRequired">
      <div class="fb-toggle">
        <input type="checkbox" id="optRequired" onchange="updateFieldFromOptions()">
        <span class="fb-toggle-track"><span class="fb-toggle-dot"></span></span>
      </div>
      <span>Mark as Required</span>
    </label>
  </div>

  <div class="fb-opt-group">
    <label class="fb-opt-label" for="optCssClass">CSS Class</label>
    <x-form-input id="optCssClass" placeholder="col-md-6 my-class..." oninput="updateFieldFromOptions()" />
  </div>

  <div class="fb-opt-group" style="margin-top:6px;">
    <button type="button" class="fb-btn fb-btn-danger w-100"
            onclick="if(editingId) confirmDel(editingId)">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6M9 6V4h6v2"/>
      </svg>
      Remove Element
    </button>
  </div>

</div>
