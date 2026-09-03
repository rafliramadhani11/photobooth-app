import PhotoBoothForm from "@/components/photo-booth-form";
import App from "@/layouts/app";

export default function Welcome() {
    return (
        <App>
            <div className="flex flex-col gap-y-3 items-center">
                <div className="w-full text-[#F53003] dark:text-[#F61500] text-5xl">
                    Event Logo
                </div>
                Lorem ipsum dolor sit amet.
            </div>

            <PhotoBoothForm className="mt-10" />
        </App>
    );
}
