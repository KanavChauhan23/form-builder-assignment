@extends('layouts.admin')

@section('content')
<div class="app-content">
  <div class="side-app">

    <div class="page-header">
      <h4 class="page-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;vertical-align:-3px"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 12h6M9 15h4"/></svg>
        Form Builder
      </h4>
    </div>

    <div class="fb-wrapper">

      {{-- TOP BAR --}}
      <div class="fb-topbar">
        <div class="fb-title-row">
          <input type="text" id="formTitle" class="fb-title-input" placeholder="Untitled Form" maxlength="200" autocomplete="off"/>
          <span class="fb-char-counter"><span id="titleCount">0</span>/200</span>
        </div>
        <div class="fb-url-row">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
          &nbsp;Submission URL:&nbsp;<span class="fb-url-text" id="formUrl">{{ url('/') }}/submit-form</span>
        </div>
      </div>

      {{-- MAIN TABS --}}
      <div class="fb-tabs">
        <button class="fb-tab active" id="tabEditorBtn" onclick="switchTab('editor')">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 12h6M9 15h4"/></svg>
          Form Editor
        </button>
        <button class="fb-tab" id="tabSettingsBtn" onclick="switchTab('settings')">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2M12 20v2M2 12h2M20 12h2M19.07 19.07l-1.41-1.41M4.93 19.07l1.41-1.41"/></svg>
          Settings
        </button>
      </div>

      {{-- EDITOR PANEL --}}
      <div id="editorPanel" class="fb-editor">

        {{-- LEFT: Canvas --}}
        <div class="fb-canvas-col">
          <div class="fb-canvas-toolbar">
            <button class="fb-toolbar-btn" id="undoBtn" onclick="undoAction()" title="Undo (Ctrl+Z)" disabled>
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 7v6h6"/><path d="M21 17a9 9 0 00-9-9 9 9 0 00-6 2.3L3 13"/></svg>
              Undo
            </button>
            <button class="fb-toolbar-btn" id="redoBtn" onclick="redoAction()" title="Redo (Ctrl+Y)" disabled>
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 7v6h-6"/><path d="M3 17a9 9 0 019-9 9 9 0 016 2.3L21 13"/></svg>
              Redo
            </button>
            <span class="fb-field-count" id="fieldCount">0 fields</span>
          </div>

          <div class="fb-dropzone" id="dropCanvas">
            <div class="fb-empty-state" id="emptyState">
              <div class="fb-empty-icon">
                <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 12h6M9 15h4"/></svg>
              </div>
              <p class="fb-empty-title">Drop fields here to build your form</p>
              <p class="fb-empty-sub">Drag any element from the right panel →</p>
            </div>
          </div>
        </div>

        {{-- RIGHT: Palette + Options --}}
        <div class="fb-palette-col">
          <div class="fb-sub-tabs">
            <button class="fb-sub-tab active" id="subAddBtn" onclick="switchSubTab('add')">Add Fields</button>
            <button class="fb-sub-tab" id="subOptBtn" onclick="switchSubTab('options')">Field Options</button>
          </div>

          {{-- Add Fields Panel --}}
          <div id="addFieldsPanel" class="fb-palette-scroll">
            <div class="fb-field-grid" id="fieldPalette">
              @include('components.field-tiles')
            </div>
          </div>

          {{-- Options Panel --}}
          <div id="fieldOptionsPanel" class="fb-palette-scroll" style="display:none;">
            <div id="noFieldSelected" class="fb-no-sel">
              <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              <p>Click the <strong>✏️ edit</strong> icon on any field to configure it here.</p>
            </div>
            <div id="fieldOptionsForm" style="display:none;">
              @include('components.field-options')
            </div>
          </div>
        </div>

      </div>

      {{-- SETTINGS PANEL --}}
      <div id="settingsPanel" class="fb-editor" style="display:none;">
        <div style="padding:28px;max-width:640px;">
          <h5 class="fb-settings-title">Form Settings</h5>
          <p class="text-muted" style="font-size:13px;">Configure global form properties.</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="fb-opt-label">Form Name</label>
                <input type="text" class="form-control fb-input" placeholder="My Form">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="fb-opt-label">Redirect URL after Submit</label>
                <input type="text" class="form-control fb-input" placeholder="https://example.com/thank-you">
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label class="fb-opt-label">Success Message</label>
            <textarea class="form-control fb-input" rows="2" placeholder="Thank you for your submission!"></textarea>
          </div>
        </div>
      </div>

      {{-- FOOTER --}}
      <div class="fb-footer">
        <button class="fb-btn fb-btn-ghost" onclick="cancelForm()">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
          Cancel
        </button>
        <div style="display:flex;gap:8px;align-items:center;">
          <button class="fb-btn fb-btn-secondary" onclick="previewForm()">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            Preview
          </button>
          <button class="fb-btn fb-btn-primary" onclick="submitForm()">
            Next
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </button>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- PREVIEW MODAL --}}
<div class="modal fade" id="previewModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content fb-modal">
      <div class="modal-header fb-modal-hdr">
        <h5 class="modal-title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:7px;vertical-align:-2px"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          Form Preview
        </h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body p-4" id="previewBody"></div>
      <div class="modal-footer fb-modal-ftr">
        <button type="button" class="fb-btn fb-btn-ghost" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- JSON MODAL --}}
<div class="modal fade" id="jsonModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content fb-modal">
      <div class="modal-header fb-modal-hdr">
        <h5 class="modal-title">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:7px;vertical-align:-2px"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
          Form JSON Schema
        </h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body p-0">
        <pre class="fb-json-pre" id="jsonOutput"></pre>
      </div>
      <div class="modal-footer fb-modal-ftr">
        <button type="button" class="fb-btn fb-btn-secondary" onclick="copyJson()">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          Copy JSON
        </button>
        <button type="button" class="fb-btn fb-btn-ghost" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- DELETE TOAST --}}
<div id="deleteToast" class="fb-del-toast" style="display:none;">
  <div class="fb-del-toast-inner">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6M9 6V4h6v2"/></svg>
    <span>Remove this field?</span>
    <button class="fb-del-confirm" id="toastConfirmBtn">Remove</button>
    <button class="fb-del-cancel" id="toastCancelBtn">Keep</button>
  </div>
</div>

{{-- SUCCESS TOAST --}}
<div id="successToast" class="fb-success-toast" style="display:none;"></div>

@endsection

@push('scripts')
<script>
/* ======================================================
   FORM BUILDER — Complete JavaScript
   ====================================================== */

// ---------- Global State ----------
var fields       = [];
var history      = [[]];
var historyIdx   = 0;
var editingId    = null;
var pendingDelId = null;

// ---------- Field Definitions ----------
var DEFS = {
  text:        { label:'Text Input',    hasOpts:false },
  textarea:    { label:'Text Area',     hasOpts:false },
  number:      { label:'Number',        hasOpts:false },
  email:       { label:'Email',         hasOpts:false },
  phone:       { label:'Phone',         hasOpts:false },
  date:        { label:'Date Picker',   hasOpts:false },
  file:        { label:'File Upload',   hasOpts:false },
  dropdown:    { label:'Dropdown',      hasOpts:true  },
  radio:       { label:'Radio Buttons', hasOpts:true  },
  checkbox:    { label:'Checkboxes',    hasOpts:true  },
  title:       { label:'Title',         hasOpts:false },
  description: { label:'Description',   hasOpts:false },
  newline:     { label:'New Line',      hasOpts:false },
  pagebreak:   { label:'Page Break',    hasOpts:false },
  hidden:      { label:'Hidden Field',  hasOpts:false },
  state:       { label:'State',         hasOpts:false },
  city:        { label:'City',          hasOpts:false },
  statecity:   { label:'State & City',  hasOpts:false }
};

// ---------- Init ----------
document.addEventListener('DOMContentLoaded', function() {
  initSortable();
  initTitleCounter();
  loadFromStorage();
  bindKeyboard();
  document.getElementById('toastConfirmBtn').addEventListener('click', function() {
    if (pendingDelId) { removeField(pendingDelId); pendingDelId = null; }
    hideDelToast();
  });
  document.getElementById('toastCancelBtn').addEventListener('click', function() {
    pendingDelId = null; hideDelToast();
  });
});

/* ======================================================
   SORTABLE
   ====================================================== */
function initSortable() {
  Sortable.create(document.getElementById('fieldPalette'), {
    group: { name:'fb', pull:'clone', put:false },
    sort: false,
    animation: 150,
    ghostClass: 'tile-ghost',
    chosenClass: 'tile-chosen',
    onStart: function() { document.getElementById('dropCanvas').classList.add('canvas-active'); },
    onEnd:   function() { document.getElementById('dropCanvas').classList.remove('canvas-active'); }
  });

  Sortable.create(document.getElementById('dropCanvas'), {
    group: { name:'fb', pull:false, put:true },
    animation: 200,
    handle: '.fb-card-handle',
    ghostClass: 'card-ghost',
    chosenClass: 'card-chosen',
    onAdd: function(evt) {
      var type = evt.item.dataset.type;
      evt.item.remove();
      if (type) addField(type, evt.newIndex);
    },
    onUpdate: function() { syncOrder(); }
  });
}

/* ======================================================
   FIELD CRUD
   ====================================================== */
function uid() { return 'f' + Date.now() + Math.random().toString(36).substr(2,5); }

function addField(type, idx) {
  var def = DEFS[type]; if (!def) return;
  var f = {
    id: uid(), type: type, label: def.label,
    placeholder:'', required:false, cssClass:'',
    defaultValue:'', minChars:'', maxChars:'',
    options: def.hasOpts ? ['Option 1','Option 2'] : []
  };
  if (idx !== undefined && idx < fields.length) fields.splice(idx, 0, f);
  else fields.push(f);
  pushHistory(); renderCanvas(); save(); updateCount();
}

function removeField(id) {
  fields = fields.filter(function(f){ return f.id !== id; });
  if (editingId === id) { editingId = null; showNoSel(); }
  pushHistory(); renderCanvas(); save(); updateCount();
}

function duplicateField(id) {
  var idx = fields.findIndex(function(f){ return f.id === id; });
  if (idx < 0) return;
  var copy = JSON.parse(JSON.stringify(fields[idx]));
  copy.id = uid(); copy.label = fields[idx].label + ' (Copy)';
  fields.splice(idx + 1, 0, copy);
  pushHistory(); renderCanvas(); save(); updateCount();
  toast('Field duplicated ✓');
}

function syncOrder() {
  var cards = document.querySelectorAll('#dropCanvas .fb-card');
  var reordered = [];
  cards.forEach(function(c) {
    var f = fields.find(function(x){ return x.id === c.dataset.id; });
    if (f) reordered.push(f);
  });
  fields = reordered;
  pushHistory(); save();
}

/* ======================================================
   RENDER CANVAS
   ====================================================== */
function renderCanvas() {
  var canvas = document.getElementById('dropCanvas');
  var empty  = document.getElementById('emptyState');
  canvas.querySelectorAll('.fb-card').forEach(function(el){ el.remove(); });
  if (!fields.length) { empty.style.display = 'flex'; return; }
  empty.style.display = 'none';
  fields.forEach(function(f) { canvas.appendChild(makeCard(f)); });
}

function makeCard(f) {
  var def = DEFS[f.type];
  var div = document.createElement('div');
  div.className = 'fb-card' + (f.id === editingId ? ' fb-card-active' : '');
  div.dataset.id   = f.id;
  div.dataset.type = f.type;
  div.innerHTML =
    '<div class="fb-card-inner">' +
      '<div class="fb-card-handle" title="Drag to reorder">' +
        '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' +
          '<circle cx="9"  cy="5"  r="1" fill="currentColor"/>' +
          '<circle cx="9"  cy="12" r="1" fill="currentColor"/>' +
          '<circle cx="9"  cy="19" r="1" fill="currentColor"/>' +
          '<circle cx="15" cy="5"  r="1" fill="currentColor"/>' +
          '<circle cx="15" cy="12" r="1" fill="currentColor"/>' +
          '<circle cx="15" cy="19" r="1" fill="currentColor"/>' +
        '</svg>' +
      '</div>' +
      '<div class="fb-card-body">' +
        '<span class="fb-card-badge">' + esc(def.label) + '</span>' +
        '<div class="fb-card-preview">' + makePreview(f) + '</div>' +
      '</div>' +
      '<div class="fb-card-actions">' +
        '<button class="fb-act-btn fb-act-edit" onclick="editField(\'' + f.id + '\')" title="Edit">' +
          '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>' +
        '</button>' +
        '<button class="fb-act-btn fb-act-dup" onclick="duplicateField(\'' + f.id + '\')" title="Duplicate">' +
          '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>' +
        '</button>' +
        '<button class="fb-act-btn fb-act-del" onclick="confirmDel(\'' + f.id + '\')" title="Delete">' +
          '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6M9 6V4h6v2"/></svg>' +
        '</button>' +
      '</div>' +
    '</div>';
  return div;
}

function makePreview(f) {
  var lbl = esc(f.label || DEFS[f.type].label);
  var ph  = esc(f.placeholder || ('Enter ' + lbl.toLowerCase() + '...'));
  var req = f.required ? ' <span class="fb-star">*</span>' : '';
  switch (f.type) {
    case 'text': case 'email': case 'phone': case 'number':
      return '<label class="pv-label">'+lbl+req+'</label><input class="pv-input" disabled placeholder="'+ph+'">';
    case 'textarea':
      return '<label class="pv-label">'+lbl+req+'</label><textarea class="pv-input pv-ta" disabled placeholder="'+ph+'"></textarea>';
    case 'date':
      return '<label class="pv-label">'+lbl+req+'</label><input class="pv-input" disabled placeholder="dd/mm/yyyy">';
    case 'file':
      return '<label class="pv-label">'+lbl+req+'</label><div class="pv-file">📎 Choose file...</div>';
    case 'dropdown':
      return '<label class="pv-label">'+lbl+req+'</label><select class="pv-input" disabled><option>Select an option</option>'+(f.options||[]).map(function(o){return '<option>'+esc(o)+'</option>';}).join('')+'</select>';
    case 'radio':
      return '<label class="pv-label">'+lbl+req+'</label><div class="pv-checks">'+(f.options||[]).map(function(o){return '<label class="pv-check"><input type="radio" disabled> '+esc(o)+'</label>';}).join('')+'</div>';
    case 'checkbox':
      return '<label class="pv-label">'+lbl+req+'</label><div class="pv-checks">'+(f.options||[]).map(function(o){return '<label class="pv-check"><input type="checkbox" disabled> '+esc(o)+'</label>';}).join('')+'</div>';
    case 'title':
      return '<h4 class="pv-title">'+lbl+'</h4>';
    case 'description':
      return '<p class="pv-desc">'+(f.defaultValue ? esc(f.defaultValue) : 'Description text...')+'</p>';
    case 'newline':
      return '<div class="pv-newline">— New Line —</div>';
    case 'pagebreak':
      return '<div class="pv-pagebreak">⏭ Page Break</div>';
    case 'hidden':
      return '<div class="pv-hidden">👁 Hidden: '+lbl+'</div>';
    case 'state':
      return '<label class="pv-label">'+lbl+req+'</label><input class="pv-input" disabled placeholder="Enter state">';
    case 'city':
      return '<label class="pv-label">'+lbl+req+'</label><input class="pv-input" disabled placeholder="Enter city">';
    case 'statecity':
      return '<label class="pv-label">'+lbl+req+'</label><div class="pv-statecity"><input class="pv-input" disabled placeholder="State"><input class="pv-input" disabled placeholder="City"></div>';
    default:
      return '<label class="pv-label">'+lbl+req+'</label><input class="pv-input" disabled placeholder="'+ph+'">';
  }
}

/* ======================================================
   EDIT FIELD
   ====================================================== */
function editField(id) {
  editingId = id;
  var f = fields.find(function(x){ return x.id === id; });
  if (!f) return;
  switchSubTab('options');
  document.querySelectorAll('.fb-card').forEach(function(c){ c.classList.remove('fb-card-active'); });
  var card = document.querySelector('[data-id="'+id+'"]');
  if (card) card.classList.add('fb-card-active');
  populateOpts(f);
  document.getElementById('noFieldSelected').style.display  = 'none';
  document.getElementById('fieldOptionsForm').style.display = 'block';
}

function showNoSel() {
  document.getElementById('noFieldSelected').style.display  = 'flex';
  document.getElementById('fieldOptionsForm').style.display = 'none';
}

function populateOpts(f) {
  var def = DEFS[f.type];
  document.getElementById('optFieldTypeBadge').textContent = def.label;
  document.getElementById('optLabel').value    = f.label    || '';
  document.getElementById('optRequired').checked = f.required || false;
  document.getElementById('optCssClass').value = f.cssClass || '';

  var needsPh = ['text','textarea','number','email','phone'].includes(f.type);
  document.getElementById('optPlaceholderRow').style.display = needsPh ? 'block' : 'none';
  if (needsPh) document.getElementById('optPlaceholder').value = f.placeholder || '';

  var needsMM = ['text','textarea'].includes(f.type);
  document.getElementById('optMinMaxRow').style.display = needsMM ? 'flex' : 'none';
  if (needsMM) {
    document.getElementById('optMinChars').value = f.minChars || '';
    document.getElementById('optMaxChars').value = f.maxChars || '';
  }

  var needsDef = ['text','number','email','hidden','description'].includes(f.type);
  document.getElementById('optDefaultRow').style.display = needsDef ? 'block' : 'none';
  if (needsDef) document.getElementById('optDefault').value = f.defaultValue || '';

  var needsOpts = def.hasOpts;
  document.getElementById('optOptionsRow').style.display = needsOpts ? 'block' : 'none';
  if (needsOpts) renderOptList(f.options || []);
}

function renderOptList(opts) {
  var c = document.getElementById('optionsList');
  c.innerHTML = '';
  opts.forEach(function(opt, i) {
    var row = document.createElement('div');
    row.className = 'fb-opt-row';
    row.innerHTML =
      '<input type="text" class="form-control fb-input" value="'+esc(opt)+'" oninput="updateOpt('+i+',this.value)">' +
      '<button class="fb-opt-del-btn" onclick="removeOpt('+i+')" type="button">' +
        '<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>' +
      '</button>';
    c.appendChild(row);
  });
}

function updateOpt(i, val) {
  var f = fields.find(function(x){ return x.id === editingId; });
  if (f) { f.options[i] = val; save(); refreshCard(editingId); }
}

function addOption() {
  var f = fields.find(function(x){ return x.id === editingId; });
  if (!f) return;
  f.options.push('New Option');
  renderOptList(f.options); save(); refreshCard(editingId);
}

function removeOpt(i) {
  var f = fields.find(function(x){ return x.id === editingId; });
  if (!f || f.options.length <= 1) return;
  f.options.splice(i, 1);
  renderOptList(f.options); save(); refreshCard(editingId);
}

function updateFieldFromOptions() {
  if (!editingId) return;
  var f = fields.find(function(x){ return x.id === editingId; });
  if (!f) return;
  f.label        = document.getElementById('optLabel').value;
  f.required     = document.getElementById('optRequired').checked;
  f.cssClass     = document.getElementById('optCssClass').value;
  f.placeholder  = document.getElementById('optPlaceholder').value;
  f.minChars     = document.getElementById('optMinChars').value;
  f.maxChars     = document.getElementById('optMaxChars').value;
  f.defaultValue = document.getElementById('optDefault').value;
  save(); refreshCard(editingId);
}

function refreshCard(id) {
  var f = fields.find(function(x){ return x.id === id; });
  var old = document.querySelector('[data-id="'+id+'"]');
  if (!f || !old) return;
  var nc = makeCard(f);
  nc.classList.add('fb-card-active');
  old.replaceWith(nc);
}

/* ======================================================
   DELETE WITH CONFIRMATION TOAST
   ====================================================== */
function confirmDel(id) {
  pendingDelId = id;
  var t = document.getElementById('deleteToast');
  t.style.display = 'flex';
  setTimeout(function(){ t.style.opacity = '1'; }, 10);
}
function hideDelToast() {
  var t = document.getElementById('deleteToast');
  t.style.opacity = '0';
  setTimeout(function(){ t.style.display = 'none'; }, 200);
}

/* ======================================================
   TABS
   ====================================================== */
function switchTab(tab) {
  document.getElementById('editorPanel').style.display   = tab === 'editor'   ? 'flex' : 'none';
  document.getElementById('settingsPanel').style.display = tab === 'settings' ? 'flex' : 'none';
  document.getElementById('tabEditorBtn').classList.toggle('active', tab === 'editor');
  document.getElementById('tabSettingsBtn').classList.toggle('active', tab === 'settings');
}
function switchSubTab(sub) {
  document.getElementById('addFieldsPanel').style.display   = sub === 'add'     ? 'block' : 'none';
  document.getElementById('fieldOptionsPanel').style.display = sub === 'options' ? 'block' : 'none';
  document.getElementById('subAddBtn').classList.toggle('active', sub === 'add');
  document.getElementById('subOptBtn').classList.toggle('active', sub === 'options');
}

/* ======================================================
   TITLE COUNTER
   ====================================================== */
function initTitleCounter() {
  var inp = document.getElementById('formTitle');
  inp.addEventListener('input', function(){
    document.getElementById('titleCount').textContent = this.value.length;
  });
}
function updateCount() {
  var n = fields.length;
  document.getElementById('fieldCount').textContent = n + (n === 1 ? ' field' : ' fields');
}

/* ======================================================
   UNDO / REDO
   ====================================================== */
function pushHistory() {
  history = history.slice(0, historyIdx + 1);
  history.push(JSON.parse(JSON.stringify(fields)));
  historyIdx = history.length - 1;
  updateUndoRedo();
}
function undoAction() {
  if (historyIdx > 0) {
    historyIdx--;
    fields = JSON.parse(JSON.stringify(history[historyIdx]));
    renderCanvas(); save(); updateCount(); updateUndoRedo();
    if (editingId && !fields.find(function(f){ return f.id === editingId; })) { editingId = null; showNoSel(); }
  }
}
function redoAction() {
  if (historyIdx < history.length - 1) {
    historyIdx++;
    fields = JSON.parse(JSON.stringify(history[historyIdx]));
    renderCanvas(); save(); updateCount(); updateUndoRedo();
  }
}
function updateUndoRedo() {
  document.getElementById('undoBtn').disabled = historyIdx <= 0;
  document.getElementById('redoBtn').disabled = historyIdx >= history.length - 1;
}
function bindKeyboard() {
  document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey||e.metaKey) && e.key === 'z' && !e.shiftKey) { e.preventDefault(); undoAction(); }
    if ((e.ctrlKey||e.metaKey) && (e.key === 'y' || (e.key === 'z' && e.shiftKey))) { e.preventDefault(); redoAction(); }
  });
}

/* ======================================================
   LOCALSTORAGE PERSISTENCE
   ====================================================== */
function save() {
  try {
    localStorage.setItem('fb_state', JSON.stringify({
      title: document.getElementById('formTitle').value,
      fields: fields
    }));
  } catch(e) {}
}
function loadFromStorage() {
  try {
    var raw = localStorage.getItem('fb_state');
    if (!raw) return;
    var st = JSON.parse(raw);
    if (st.title) {
      document.getElementById('formTitle').value = st.title;
      document.getElementById('titleCount').textContent = st.title.length;
    }
    if (Array.isArray(st.fields) && st.fields.length) {
      fields = st.fields;
      history = [[], JSON.parse(JSON.stringify(fields))];
      historyIdx = 1;
      renderCanvas(); updateCount(); updateUndoRedo();
    }
  } catch(e) {}
}

/* ======================================================
   PREVIEW
   ====================================================== */
function previewForm() {
  var title = document.getElementById('formTitle').value || 'Untitled Form';
  var html = '<div class="pv-wrapper"><h3 class="pv-form-title">'+esc(title)+'</h3><hr>';
  fields.forEach(function(f) {
    var lbl = esc(f.label || DEFS[f.type].label);
    var ph  = esc(f.placeholder || '');
    var req = f.required ? ' <span style="color:#ef4444">*</span>' : '';
    var cls = esc(f.cssClass || '');
    switch(f.type) {
      case 'text': case 'email': case 'phone': case 'number':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label">'+lbl+req+'</label><input type="'+f.type+'" class="form-control" placeholder="'+ph+'"></div>'; break;
      case 'textarea':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label">'+lbl+req+'</label><textarea class="form-control" rows="3" placeholder="'+ph+'"></textarea></div>'; break;
      case 'date':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label">'+lbl+req+'</label><input type="date" class="form-control"></div>'; break;
      case 'file':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label">'+lbl+req+'</label><input type="file" class="form-control"></div>'; break;
      case 'dropdown':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label">'+lbl+req+'</label><select class="form-control"><option value="">Select an option</option>'+(f.options||[]).map(function(o){return '<option>'+esc(o)+'</option>';}).join('')+'</select></div>'; break;
      case 'radio':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label d-block">'+lbl+req+'</label>'+(f.options||[]).map(function(o){return '<div class="form-check"><input class="form-check-input" type="radio" name="r_'+f.id+'"><label class="form-check-label">'+esc(o)+'</label></div>';}).join('')+'</div>'; break;
      case 'checkbox':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label d-block">'+lbl+req+'</label>'+(f.options||[]).map(function(o){return '<div class="form-check"><input class="form-check-input" type="checkbox"><label class="form-check-label">'+esc(o)+'</label></div>';}).join('')+'</div>'; break;
      case 'title':
        html += '<h4 class="pv-title mt-3">'+lbl+'</h4>'; break;
      case 'description':
        html += '<p class="text-muted mb-3">'+esc(f.defaultValue || 'Description text here.')+'</p>'; break;
      case 'newline':
        html += '<div class="mb-3"></div>'; break;
      case 'pagebreak':
        html += '<hr><div class="text-center text-muted small mb-3">— Page Break —</div>'; break;
      case 'hidden':
        html += '<input type="hidden" name="'+lbl+'" value="'+esc(f.defaultValue||'')+'">'; break;
      case 'state':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label">'+lbl+req+'</label><input type="text" class="form-control" placeholder="Enter state"></div>'; break;
      case 'city':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label">'+lbl+req+'</label><input type="text" class="form-control" placeholder="Enter city"></div>'; break;
      case 'statecity':
        html += '<div class="form-group mb-3 '+cls+'"><label class="pv-label">'+lbl+req+'</label><div class="row"><div class="col-6"><input type="text" class="form-control" placeholder="State"></div><div class="col-6"><input type="text" class="form-control" placeholder="City"></div></div></div>'; break;
    }
  });
  if (!fields.length) html += '<p class="text-center text-muted py-4">No fields added yet.</p>';
  else html += '<div class="mt-4"><button class="btn btn-primary">Submit</button></div>';
  html += '</div>';
  document.getElementById('previewBody').innerHTML = html;
  $('#previewModal').modal('show');
}

/* ======================================================
   JSON OUTPUT (Next button)
   ====================================================== */
function submitForm() {
  var schema = {
    formTitle: document.getElementById('formTitle').value || 'Untitled Form',
    submissionUrl: document.getElementById('formUrl').textContent,
    createdAt: new Date().toISOString(),
    totalFields: fields.length,
    fields: fields.map(function(f) {
      var out = { id:f.id, type:f.type, label:f.label, required:f.required };
      if (f.placeholder)  out.placeholder  = f.placeholder;
      if (f.cssClass)     out.cssClass     = f.cssClass;
      if (f.defaultValue) out.defaultValue = f.defaultValue;
      if (f.minChars)     out.minChars     = f.minChars;
      if (f.maxChars)     out.maxChars     = f.maxChars;
      if (f.options && f.options.length) out.options = f.options;
      return out;
    })
  };
  console.log('Form JSON Schema:', schema);
  document.getElementById('jsonOutput').textContent = JSON.stringify(schema, null, 2);
  $('#jsonModal').modal('show');
}

function copyJson() {
  var text = document.getElementById('jsonOutput').textContent;
  if (navigator.clipboard) {
    navigator.clipboard.writeText(text).then(function(){ toast('Copied to clipboard ✓'); });
  } else {
    var el = document.createElement('textarea');
    el.value = text; document.body.appendChild(el); el.select();
    document.execCommand('copy'); document.body.removeChild(el);
    toast('Copied ✓');
  }
}

/* ======================================================
   CANCEL
   ====================================================== */
function cancelForm() {
  if (fields.length > 0 && !confirm('Discard all fields and start over?')) return;
  fields = []; editingId = null;
  history = [[]]; historyIdx = 0;
  document.getElementById('formTitle').value = '';
  document.getElementById('titleCount').textContent = '0';
  renderCanvas(); save(); updateCount(); updateUndoRedo();
  showNoSel(); switchSubTab('add');
}

/* ======================================================
   TOAST NOTIFICATION
   ====================================================== */
function toast(msg) {
  var t = document.getElementById('successToast');
  t.textContent = msg; t.style.display = 'block'; t.style.opacity = '1';
  clearTimeout(t._t);
  t._t = setTimeout(function(){ t.style.opacity='0'; setTimeout(function(){ t.style.display='none'; },300); }, 2200);
}

/* ======================================================
   HELPER
   ====================================================== */
function esc(s) {
  return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
</script>
@endpush
