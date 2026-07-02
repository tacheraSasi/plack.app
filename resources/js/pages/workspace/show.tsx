import { Head } from '@inertiajs/react';
import CreateChannelDialog from '@/components/create-channel-dialog';
import WorkspaceLayout from '@/layouts/workspace-layout';

type Channel = {
    id: string;
    name: string;
    slug: string;
};

type WorkspaceSummary = {
    id: string;
    name: string;
    slug: string;
};

type Workspace = WorkspaceSummary & {
    channels: Channel[];
};

type Paginated<T> = {
    data: T[];
};

export default function WorkspaceShow({
    workspace,
    workspaces,
}: {
    workspace: Workspace;
    workspaces?: Paginated<WorkspaceSummary>;
}) {
    const channels = workspace.channels;
    const channelCount = channels.length;

    return (
        <WorkspaceLayout workspace={workspace} workspaces={workspaces?.data}>
            <Head title={workspace.name} />

            {/* header */}
            <header className="flex items-baseline justify-between gap-3 border-b border-line px-6 py-[15px]">
                <div className="flex items-baseline gap-3">
                    <span className="text-[15px] font-semibold text-amber">
                        {workspace.name}
                    </span>
                    <span className="text-[11px] text-mute">
                        {channelCount === 1
                            ? '1 channel'
                            : `${channelCount} channels`}
                    </span>
                </div>

                <CreateChannelDialog workspaceSlug={workspace.slug} />
            </header>

            {/* message log — bottom-anchored empty state */}
            <div className="flex flex-1 flex-col justify-end gap-[14px] overflow-y-auto px-6 py-[18px] text-[12.5px] leading-[1.55]">
                <div className="text-faint">
                    {channelCount === 0
                        ? '# no channels yet — create one to get started'
                        : '# select a channel to start'}
                </div>
            </div>

            {/* composer — visual only, no channel selected */}
            <form
                onSubmit={(e) => e.preventDefault()}
                className="mx-6 mb-5 flex items-center gap-2 border border-line px-[14px] py-[11px] text-[12.5px] text-faint"
            >
                <span className="text-green">&gt;</span>
                <input
                    type="text"
                    disabled
                    placeholder="select a channel to send a message"
                    className="min-w-0 flex-1 bg-transparent text-fg caret-green outline-none placeholder:text-faint"
                />
            </form>
        </WorkspaceLayout>
    );
}
