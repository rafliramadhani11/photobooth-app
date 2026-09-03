import React, { ReactNode } from "react";
import { cn } from "@/lib/utils";

export interface CenteredLayoutProps {
    children: ReactNode;
    /**
     * Additional CSS classes for the outer full-screen wrapper
     */
    className?: string;
    /**
     * Additional CSS classes for the centered container
     */
    containerClassName?: string;
    /**
     * If true, wraps the content in a styled card box
     */
    withCard?: boolean;
    /**
     * Additional CSS classes when `withCard` is true
     */
    cardClassName?: string;
    /**
     * Optional header element inside or above the centered content
     */
    header?: ReactNode;
    /**
     * Optional footer element inside or below the centered content
     */
    footer?: ReactNode;
}

export default function App({
    children,
    className,
    containerClassName,
    withCard = false,
    cardClassName,
    header,
    footer,
}: CenteredLayoutProps) {
    return (
        <main
            className={cn(
                "min-h-screen w-full flex flex-col items-center justify-center p-4 sm:p-6 md:p-8 bg-background text-foreground",
                className,
            )}
        >
            <div
                className={cn(
                    "w-full max-w-md flex flex-col items-center justify-center",
                    containerClassName,
                )}
            >
                {header && (
                    <header className="w-full mb-6 text-center">
                        {header}
                    </header>
                )}

                {withCard ? (
                    <div
                        className={cn(
                            "w-full bg-card text-card-foreground rounded-2xl border border-border p-6 sm:p-8 shadow-sm",
                            cardClassName,
                        )}
                    >
                        {children}
                    </div>
                ) : (
                    children
                )}

                {footer && (
                    <footer className="w-full mt-6 text-center text-sm text-muted-foreground">
                        {footer}
                    </footer>
                )}
            </div>
        </main>
    );
}
