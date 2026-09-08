import PhotoBoothForm from "@/components/photo-booth-form";
import App from "@/layouts/app";
import { Head } from "@inertiajs/react";
import { Calendar, MapPin } from "lucide-react";

export interface PackageItem {
    id: number;
    name: string;
    desc?: string;
    price?: number | string;
}

export interface EventData {
    id: number;
    name: string;
    desc?: string;
    location?: string;
    event_date: string;
    is_active: boolean;
    logo?: string;
    logo_url?: string;
    packages?: PackageItem[];
}

interface WelcomeProps {
    event: EventData | null;
}

export default function Welcome({ event }: WelcomeProps) {
    if (!event) {
        return (
            <App>
                <Head title="Tidak Ada Event Aktif" />
                <div className="flex flex-col items-center justify-center text-center p-8 bg-card text-card-foreground rounded-2xl border border-border shadow-sm max-w-md w-full">
                    <div className="size-16 rounded-full bg-muted flex items-center justify-center text-muted-foreground mb-4">
                        <Calendar className="size-8 stroke-[1.5]" />
                    </div>
                    <h1 className="text-xl font-bold tracking-tight">
                        Tidak Ada Event Hari Ini
                    </h1>
                    <p className="text-sm text-muted-foreground mt-2 leading-relaxed">
                        Saat ini tidak ada event photo booth yang sedang aktif
                        untuk hari ini. Silakan hubungi admin atau periksa
                        jadwal acara lainnya.
                    </p>
                </div>
            </App>
        );
    }

    return (
        <App>
            <Head title={event.name} />

            <div className="flex flex-col gap-y-3 items-center text-center w-full">
                {event.logo_url ? (
                    <div className="size-24 md:size-28 rounded-2xl overflow-hidden border border-border shadow-md bg-card p-1">
                        <img
                            src={event.logo_url}
                            alt={event.name}
                            className="size-full object-contain rounded-xl"
                        />
                    </div>
                ) : (
                    <div className="w-full text-primary text-3xl md:text-4xl font-extrabold tracking-tight">
                        {event.name}
                    </div>
                )}

                <div className="space-y-1 mt-1">
                    <h1 className="text-2xl font-bold text-foreground tracking-tight">
                        {event.name}
                    </h1>

                    {event.location && (
                        <div className="flex items-center justify-center gap-1.5 text-xs text-muted-foreground">
                            <MapPin className="size-3.5 text-muted-foreground" />
                            <span>{event.location}</span>
                        </div>
                    )}

                    {event.desc && (
                        <p className="text-xs text-muted-foreground max-w-sm mx-auto leading-relaxed mt-1">
                            {event.desc}
                        </p>
                    )}
                </div>
            </div>

            <PhotoBoothForm
                eventId={event.id}
                packages={event.packages ?? []}
                className="mt-8"
            />
        </App>
    );
}
