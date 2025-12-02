<?php
// Contato
?>
<div class="card max-w-3xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Entre em contato</h1>
    <p class="text-gray-600 mb-4">Envie sua mensagem pelo formulário abaixo.</p>

    <form method="post" action="#">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input name="nome" placeholder="Seu nome" class="border rounded px-3 py-2" />
            <input name="email" placeholder="Seu e-mail" class="border rounded px-3 py-2" />
        </div>
        <textarea name="mensagem" placeholder="Escreva sua mensagem" class="w-full mt-4 border rounded px-3 py-2" rows="5"></textarea>
        <div class="mt-4">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Enviar mensagem</button>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Eventos</h2>
                <div class="flex space-x-2">
                    <button id="view-week" class="px-3 py-1 bg-gray-200 text-gray-700 rounded">Semana</button>
                </div>
            </div>

            <div id="appointments-list">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Hoje</h3>
                    <div class="space-y-3">
                        <div class="border-l-4 border-indigo-500 pl-4 py-2 bg-indigo-50 rounded-r">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-600">Psicoterapia Individual</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-medium text-gray-800">10:00 - 11:00</p>
                                    <p class="text-xs text-gray-500">Confirmado</p>
                                </div>
                            </div>
                        </div>
                        <div class="border-l-4 border-pink-500 pl-4 py-2 bg-pink-50 rounded-r">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-600">Psicoterapia de Casal</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-medium text-gray-800">14:00 - 15:30</p>
                                    <p class="text-xs text-gray-500">Confirmado</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Amanhã</h3>
                    <div class="space-y-3">
                        <div class="border-l-4 border-green-500 pl-4 py-2 bg-green-50 rounded-r">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium text-gray-800">Grupo de Apoio</h4>
                                    <p class="text-sm text-gray-600">Bariátricas - 5 participantes</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-medium text-gray-800">18:00 - 19:30</p>
                                    <p class="text-xs text-gray-500">Confirmado</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="week-appointments" class="hidden">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Esta Semana</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">17 de Junho, Quarta-feira</h4>
                            <div class="border-l-4 border-yellow-500 pl-4 py-2 bg-yellow-50 rounded-r mb-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-600">Orientação Profissional</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-800">09:00 - 10:30</p>
                                        <p class="text-xs text-gray-500">Confirmado</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">18 de Junho, Quinta-feira</h4>
                            <div class="border-l-4 border-indigo-500 pl-4 py-2 bg-indigo-50 rounded-r mb-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Patrícia Oliveira</h4>
                                        <p class="text-sm text-gray-600">Psicoterapia Individual</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-800">11:00 - 12:00</p>
                                        <p class="text-xs text-gray-500">Confirmado</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">19 de Junho, Sexta-feira</h4>
                            <div class="border-l-4 border-purple-500 pl-4 py-2 bg-purple-50 rounded-r">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Palestra Empresarial</h4>
                                        <p class="text-sm text-gray-600">Saúde Mental no Trabalho</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-800">15:00 - 17:00</p>
                                        <p class="text-xs text-gray-500">Confirmado</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>
</div>