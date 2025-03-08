import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Character {
    id: number;
    name: string;
    status: string;
    species: string;
    type: string,
    image: string;
    created: string;
    url: string;
    location: CharacterLocation;
    origin: CharacterOrigin;
    episode: Array
}

export interface CharacterLocation {
    name: string;
    location: string;
}

export interface CharacterOrigin {
    name: string;
    location: string;
}

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Pagination {
    current: number,
    count: number;
    pages: number;
    next: number;
    prev: number;
}

export type BreadcrumbItemType = BreadcrumbItem;
