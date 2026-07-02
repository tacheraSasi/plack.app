<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateWorkspace;
use App\Actions\DeleteWorkspace;
use App\Actions\UpdateWorkspace;
use App\Http\Requests\CreateWorkspaceRequest;
use App\Http\Requests\DeleteWorkspaceRequest;
use App\Http\Requests\UpdateWorkspaceRequest;
use App\Models\User;
use App\Models\Workspace;
use App\Queries\ListWorkspace;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class WorkspaceController
{
    public function index(#[CurrentUser] User $user): RedirectResponse|Response
    {
        $workspace = $user->workspaces()->oldest()->first();

        if ($workspace instanceof Workspace) {
            return to_route('workspace.show', $workspace);
        }

        return Inertia::render('workspace/empty');
    }

    public function show(#[CurrentUser] User $user, Workspace $workspace, ListWorkspace $listWorkspace): Response
    {
        return Inertia::render('workspace/show', [
            'workspace' => $workspace->load(['channels' => fn (HasMany $channels) => $channels->latest()]),
            'workspaces' => $listWorkspace->get($user),
        ]);
    }

    public function store(
        CreateWorkspaceRequest $request,
        #[CurrentUser] User $user,
        CreateWorkspace $createWorkspace,
    ): RedirectResponse {
        $name = $request->string('name')->value();

        $createWorkspace->handle($user, $name);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Workspace created.'),
        ]);

        return back();
    }

    public function update(
        UpdateWorkspaceRequest $request,
        Workspace $workspace,
        UpdateWorkspace $updateWorkspace,
    ): RedirectResponse {
        $name = $request->string('name')->value();
        $slug = $request->string('slug')->value();

        $updateWorkspace->handle($workspace, $name, $slug);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Workspace updated.'),
        ]);

        return back();
    }

    public function destroy(
        DeleteWorkspaceRequest $request,
        Workspace $workspace,
        DeleteWorkspace $deleteWorkspace,
    ): RedirectResponse {
        $deleteWorkspace->handle($workspace);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Workspace deleted.'),
        ]);

        return back();
    }
}
