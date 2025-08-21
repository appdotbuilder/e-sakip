import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { BarChart3, BookOpen, Building2, ClipboardCheck, FileText, FolderOpen, LayoutGrid, Target, Users } from 'lucide-react';
import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Organizations',
        href: '/organizations',
        icon: Building2,
    },
    {
        title: 'Strategic Plans',
        href: '/strategic-plans',
        icon: Target,
    },
    {
        title: 'Performance',
        href: '/performance',
        icon: BarChart3,
    },
    {
        title: 'Reports',
        href: '/reports',
        icon: FileText,
    },
    {
        title: 'Evaluations',
        href: '/evaluations',
        icon: ClipboardCheck,
    },
    {
        title: 'Logframes',
        href: '/logframes',
        icon: FolderOpen,
    },
    {
        title: 'Users',
        href: '/users',
        icon: Users,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'E-SAKIP Docs',
        href: '#',
        icon: BookOpen,
    },
    {
        title: 'Support',
        href: '#',
        icon: FolderOpen,
    },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
