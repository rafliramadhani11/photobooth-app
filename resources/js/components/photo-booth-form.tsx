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

interface PhotoBoothForm {
    className?: string;
}

export default function PhotoBoothForm({ className }: PhotoBoothForm) {
    return (
        <FieldSet className={cn("w-full", className)}>
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
                            id="name"
                            autoComplete="off"
                            placeholder="Nama Kamu"
                        />
                    </InputGroup>
                </Field>

                {/* PAKET PHOTOBOOTH */}
                <Field className="w-full">
                    <FieldLabel htmlFor="name" className="font-semibold">
                        2. Paket Photobooth
                        <span className="text-destructive">*</span>
                    </FieldLabel>
                    <RadioGroup defaultValue="plus">
                        <FieldLabel htmlFor="plus-plan">
                            <Field
                                orientation="horizontal"
                                className="shadow-lg"
                            >
                                <FieldContent>
                                    <FieldTitle>PAKET 1</FieldTitle>
                                    <FieldDescription className="text-xs">
                                        Soft File HD + Cetak Foto Fisik
                                    </FieldDescription>
                                </FieldContent>
                                <RadioGroupItem value="plus" id="plus-plan" />
                            </Field>
                        </FieldLabel>
                    </RadioGroup>
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
    );
}
