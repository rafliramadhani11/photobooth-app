import { ArrowRight, ShieldCheck, User } from "lucide-react";
import {
    Field,
    FieldContent,
    FieldDescription,
    FieldGroup,
    FieldLabel,
    FieldLegend,
    FieldSet,
    FieldTitle,
} from "./ui/field";
import { InputGroup, InputGroupAddon, InputGroupInput } from "./ui/input-group";
import { RadioGroup, RadioGroupItem } from "./ui/radio-group";
import { Button } from "./ui/button";
import { cn } from "@/lib/utils";
import { Form } from "@inertiajs/react";
import TransactionController from "@/actions/App/Http/Controllers/TransactionController";

import { PackageItem } from "@/pages/welcome";

interface PhotoBoothFormProps {
    className?: string;
    eventId?: number;
    packages?: PackageItem[];
}

export default function PhotoBoothForm({
    className,
    eventId,
    packages = [],
}: PhotoBoothFormProps) {
    return (
        <Form
            action={TransactionController.store()}
            className={cn("w-full", className)}
        >
            {eventId && <input type="hidden" name="event_id" value={eventId} />}

            <FieldSet>
                <FieldGroup>
                    {/* ATAS NAMA SIAPA */}
                    <Field className="w-full">
                        <FieldLabel htmlFor="name" className="font-semibold">
                            1. Atas Nama Siapa ?
                            <span className="text-destructive">*</span>
                        </FieldLabel>
                        <InputGroup className="py-5 px-1 gap-x-2 border-2 border-input has-[[data-slot=input-group-control]:focus-visible]:border-primary has-[[data-slot=input-group-control]:focus-visible]:ring-0 text-xs">
                            <InputGroupAddon>
                                <User className="size-5" />
                            </InputGroupAddon>
                            <InputGroupInput
                                required
                                name="customer_name"
                                id="name"
                                autoComplete="off"
                                placeholder="Nama Kamu"
                            />
                        </InputGroup>
                    </Field>

                    {/* PAKET PHOTOBOOTH */}
                    <Field className="w-full">
                        <FieldLabel className="font-semibold">
                            2. Paket Photobooth
                            <span className="text-destructive">*</span>
                        </FieldLabel>

                        {packages.length > 0 ? (
                            <RadioGroup
                                name="package_id"
                                defaultValue={packages[0]?.id?.toString()}
                                className="flex flex-col gap-3 w-full"
                            >
                                {packages.map((pkg, idx) => {
                                    // Dummy harga jika pkg.price belum diset di database
                                    const rawPrice = pkg.price;
                                    const formattedPrice =
                                        typeof rawPrice === "number"
                                            ? new Intl.NumberFormat("id-ID", {
                                                  style: "currency",
                                                  currency: "IDR",
                                                  maximumFractionDigits: 0,
                                              }).format(rawPrice)
                                            : rawPrice;

                                    return (
                                        <FieldLabel
                                            key={pkg.id}
                                            htmlFor={`package-${pkg.id}`}
                                            className="cursor-pointer"
                                        >
                                            <Field
                                                orientation="horizontal"
                                                className="shadow-sm hover:shadow-md transition-shadow duration-200 py-3 px-3.5"
                                            >
                                                <FieldContent>
                                                    <div className="flex items-center gap-2 flex-wrap">
                                                        <FieldTitle className="font-bold tracking-tight">
                                                            {pkg.name}
                                                        </FieldTitle>
                                                        <span className="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-primary/10 text-primary dark:bg-primary/20">
                                                            {formattedPrice}
                                                        </span>
                                                    </div>
                                                    {pkg.desc && (
                                                        <FieldDescription className="text-xs text-muted-foreground mt-0.5">
                                                            {pkg.desc}
                                                        </FieldDescription>
                                                    )}
                                                </FieldContent>
                                                <RadioGroupItem
                                                    value={pkg.id.toString()}
                                                    id={`package-${pkg.id}`}
                                                />
                                            </Field>
                                        </FieldLabel>
                                    );
                                })}
                            </RadioGroup>
                        ) : (
                            <div className="p-4 rounded-xl border border-dashed border-border text-center text-xs text-muted-foreground">
                                Belum ada paket yang tersedia untuk event ini.
                            </div>
                        )}
                    </Field>

                    {/* FORM ACTIONS */}
                    <div className="w-full">
                        <Button
                            size="lg"
                            className="w-full py-6 text-base font-bold shadow-lg transition-all duration-200 hover:scale-[1.01] active:scale-[0.98] flex items-center justify-between px-6 group"
                        >
                            <div className="flex items-center gap-2.5">
                                <ShieldCheck className="w-5 h-5" />
                                <span>Lanjut ke Pembayaran</span>
                            </div>

                            <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                        </Button>
                    </div>
                </FieldGroup>
            </FieldSet>
        </Form>
    );
}
