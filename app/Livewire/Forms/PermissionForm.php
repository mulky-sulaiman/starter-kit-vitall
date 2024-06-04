<?php

namespace App\Livewire\Forms;

use Illuminate\Validation\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Permission;
use Closure;

class PermissionForm extends Form
{
    public ?Permission $permission;

    public String $name = '';

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'lowercase',
                Rule::unique('permissions')->ignore($this->name),
                function (string $attribute, mixed $value, Closure $fail) {
                    // Check invalid formats other than dots
                    $pattern = '/[^.*\w]/';
                    if (preg_match($pattern, $value)) {
                        $fail("Invalid format detected for {$attribute}");
                    }
                    // Check if dot(.) separator exists
                    if (!str_contains($value, '.')) {
                        $fail("The {$attribute} does not contains dot(.) separator");
                    }
                    // Check for min words of 2
                    if (sizeof((explode('.', $value))) < 2) {
                        $fail("Minimum 2 words acceptable for {$attribute}");
                    }
                    // Check for max words of 3
                    if (sizeof((explode('.', $value))) > 3) {
                        $fail("Only 3 words max can be accepted for {$attribute}");
                    }
                },
            ],
        ];
    }

    public function setPermission(Permission $permission)
    {
        $this->permission = $permission;
        $this->name = $permission->name;
    }

    public function store()
    {
        $validated = $this->validate();
        $exploded = array_map('ucfirst', explode('.', $validated['name']));
        $group = $exploded[0];
        $label = implode(" ", $exploded);
        Permission::create([
            'name' => $validated['name'],
            'group' => $group,
            'label' => $label
        ]);
    }

    public function update()
    {
        $validated = $this->validate();
        $exploded = array_map('ucfirst', explode('.', $validated['name']));
        $group = $exploded[0];
        $label = implode(" ", $exploded);
        $this->permission->update([
            'name' => $validated['name'],
            'group' => $group,
            'label' => $label
        ]);
        $this->reset();
    }
}
