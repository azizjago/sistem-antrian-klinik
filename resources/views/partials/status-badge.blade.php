@php
    $classes = [
        'menunggu' => 'bg-warning-subtle text-warning-emphasis',
        'dipanggil' => 'bg-primary-subtle text-primary-emphasis',
        'selesai' => 'bg-success-subtle text-success-emphasis',
        'skip' => 'bg-secondary-subtle text-secondary-emphasis',
    ];
@endphp

<span class="badge badge-status {{ $classes[$status] ?? 'bg-light text-dark' }}">{{ ucfirst($status) }}</span>
