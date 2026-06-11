@php
$groups = [
  'Basic Inputs' => [
    ['type'=>'text',     'label'=>'Text Input',   'svg'=>'<path d="M17 6H3M12 12H3M8 18H3"/><line x1="21" y1="6" x2="17" y2="18"/>'],
    ['type'=>'textarea', 'label'=>'Text Area',    'svg'=>'<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7 8h10M7 12h10M7 16h6"/>'],
    ['type'=>'number',   'label'=>'Number',       'svg'=>'<rect x="2" y="7" width="8" height="10" rx="1"/><path d="M14 7h8M14 12h8M14 17h5"/>'],
    ['type'=>'email',    'label'=>'Email',        'svg'=>'<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>'],
    ['type'=>'phone',    'label'=>'Phone',        'svg'=>'<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>'],
    ['type'=>'date',     'label'=>'Date Picker',  'svg'=>'<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>'],
    ['type'=>'file',     'label'=>'File Upload',  'svg'=>'<path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"/>'],
  ],
  'Choice Fields' => [
    ['type'=>'dropdown', 'label'=>'Dropdown',     'svg'=>'<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M8 10l4 4 4-4"/>'],
    ['type'=>'radio',    'label'=>'Radio Buttons','svg'=>'<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3" fill="currentColor"/>'],
    ['type'=>'checkbox', 'label'=>'Checkboxes',   'svg'=>'<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>'],
  ],
  'Layout & Structure' => [
    ['type'=>'title',       'label'=>'Title',       'svg'=>'<path d="M4 6h16M4 12h10"/><line x1="6" y1="3" x2="6" y2="21" stroke-linecap="round"/>'],
    ['type'=>'description', 'label'=>'Description', 'svg'=>'<line x1="21" y1="6" x2="3" y2="6"/><line x1="21" y1="12" x2="3" y2="12"/><line x1="17" y1="18" x2="3" y2="18"/>'],
    ['type'=>'newline',     'label'=>'New Line',    'svg'=>'<path d="M9 10l-4 4 4 4"/><path d="M20 4v7a4 4 0 01-4 4H5"/>'],
    ['type'=>'pagebreak',   'label'=>'Page Break',  'svg'=>'<line x1="5" y1="12" x2="19" y2="12"/><polyline points="15 8 19 12 15 16"/><line x1="3" y1="4" x2="3" y2="20"/>'],
    ['type'=>'hidden',      'label'=>'Hidden Field','svg'=>'<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'],
  ],
  'Location' => [
    ['type'=>'state',    'label'=>'State',       'svg'=>'<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
    ['type'=>'city',     'label'=>'City',        'svg'=>'<line x1="3" y1="22" x2="21" y2="22"/><rect x="4" y="10" width="6" height="12"/><rect x="14" y="4" width="6" height="18"/>'],
    ['type'=>'statecity','label'=>'State & City','svg'=>'<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>'],
  ],
];
@endphp

@foreach($groups as $groupName => $tiles)
  <div class="fb-palette-group">{{ $groupName }}</div>
  @foreach($tiles as $tile)
    <div class="fb-field-tile" data-type="{{ $tile['type'] }}" title="Drag to add {{ $tile['label'] }}">
      <div class="fb-tile-icon">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          {!! $tile['svg'] !!}
        </svg>
      </div>
      <span class="fb-tile-label">{{ $tile['label'] }}</span>
    </div>
  @endforeach
@endforeach
