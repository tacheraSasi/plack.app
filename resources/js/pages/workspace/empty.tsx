import { Head } from '@inertiajs/react';
import CreateWorkspaceDialog from '@/components/create-workspace-dialog';

/**
 * Shown when the current user has no workspaces yet (e.g. right after
 * registration). The workspace index redirects here instead of listing
 * workspaces — Plack is workspace-scoped, so the one job is to create the
 * first one, after which the index redirects straight into it.
 */
export default function WorkspaceEmpty() {
    return (
        <div className="flex min-h-screen flex-col items-center justify-center gap-8 bg-ink-950 px-10 text-center font-mono">
            <Head title="Create your workspace" />

            {/* wordmark */}
            <div className="inline-flex items-center text-[27px] font-semibold text-amber">
                plack
                <span className="ml-[7px] inline-block h-[22px] w-[8px] animate-blink bg-green" />
            </div>

            <div>
                <div className="text-[9px] tracking-[.32em] text-mute uppercase">
                    no workspaces yet
                </div>
                <p className="mt-[9px] text-[13px] text-dim">
                    Create your first workspace to get started.
                </p>
            </div>

            <CreateWorkspaceDialog />
        </div>
    );
}
